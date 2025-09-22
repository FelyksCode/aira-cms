<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\MultiFactor\Contracts\HasBeforeChallengeHook;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use Satusehat\Integration\OAuth2Client;

class Login extends BaseLogin
{
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        /** @var SessionGuard $authGuard */
        $authGuard = Filament::auth();

        $authProvider = $authGuard->getProvider();
        /** @phpstan-ignore-line */
        $credentials = $this->getCredentialsFromFormData($data);

        $user = $authProvider->retrieveByCredentials($credentials);

        if ((! $user) || (! $authProvider->validateCredentials($user, $credentials))) {
            $this->userUndertakingMultiFactorAuthentication = null;

            $this->fireFailedEvent($authGuard, $user, $credentials);
            $this->throwFailureValidationException();
        }

        if (
            filled($this->userUndertakingMultiFactorAuthentication) &&
            (decrypt($this->userUndertakingMultiFactorAuthentication) === $user->getAuthIdentifier())
        ) {
            $this->multiFactorChallengeForm->validate();
        } else {
            foreach (Filament::getMultiFactorAuthenticationProviders() as $multiFactorAuthenticationProvider) {
                if (! $multiFactorAuthenticationProvider->isEnabled($user)) {
                    continue;
                }

                $this->userUndertakingMultiFactorAuthentication = encrypt($user->getAuthIdentifier());

                if ($multiFactorAuthenticationProvider instanceof HasBeforeChallengeHook) {
                    $multiFactorAuthenticationProvider->beforeChallenge($user);
                }

                break;
            }

            if (filled($this->userUndertakingMultiFactorAuthentication)) {
                $this->multiFactorChallengeForm->fill();

                return null;
            }
        }

        if (! $authGuard->attemptWhen($credentials, function (Authenticatable $user): bool {
            if (! ($user instanceof FilamentUser)) {
                return true;
            }

            return $user->canAccessPanel(Filament::getCurrentOrDefaultPanel());
        }, $data['remember'] ?? false)) {
            $this->fireFailedEvent($authGuard, $user, $credentials);
            $this->throwFailureValidationException();
        }

        session()->regenerate();

        // Generate OAuth
        $client = new OAuth2Client;
        $token = $client->token();

        // Store token in satusehat_token table (package's intended table)
        // DB::connection(config('satusehatintegration.database_connection_satusehat'))
        //     ->table(config('satusehatintegration.token_table_name'))
        //     ->updateOrInsert(
        //         [
        //             'environment' => config('satusehatintegration.satusehat_env'),
        //             'client_id' => config('satusehatintegration.clientid'),
        //         ],
        //         [
        //             'token' => $token,
        //             'updated_at' => now(),
        //             'created_at' => now(),
        //         ]
        //     );

        // Temporarily store token in personal_access_tokens table
        DB::table('personal_access_tokens')->updateOrInsert(
            [
                'tokenable_type' => 'App\Models\User',
                'tokenable_id' => auth()->id(),
                'name' => 'satusehat_oauth_token',
            ],
            [
                'token' => $token,
                'abilities' => json_encode(['satusehat:access']),
                'expires_at' => now()->addSeconds(86399), // 24 hours
                'last_used_at' => now(),
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );


        return app(LoginResponse::class);
    }
}
