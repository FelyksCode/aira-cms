<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Satusehat\Integration\OAuth2Client;

class KYC extends Page
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationLabel = "KYC";
    protected static ?string $title = 'Know You Customer (KYC)';
    protected static string | UnitEnum | null $navigationGroup = 'FHIR';
    protected static ?int $navigationSort = 2;

    protected static bool $shouldRegisterNavigation = true;

    protected string $view = 'filament.pages.k-y-c';

    public ?string $token = null;
    public function mount(): void
    {
        $this->token = auth()->user()->getSatuSehatToken();

        // Contoh success message
        if (session('success')) {
            Notification::make()
                ->title('Berhasil')
                ->body(session('success'))
                ->success()
                ->send();
        }

        if (session('error')) {
            Notification::make()
                ->title('Gagal')
                ->body(session('error'))
                ->danger()
                ->persistent()
                ->send();
        }
    }
}
