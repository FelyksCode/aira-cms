<div class="login-container">
    <div class="login-left">

        <div class="left-content">
            <h2>Welcome to<br>UMN Cancer Society</h2>
        </div>
    </div>

    <div class="login-right">
        <div class="login-box">
            <img src="{{ URL('storage/images/logo.PNG') }}" alt="UMN Cancer Society" class="login-logo"
                onclick="window.location='{{ config('app.frontend_url') }}'" style="cursor:pointer;">
            <h3>Login to your account</h3>

            <form wire:submit="authenticate" class="login-form">
                {{ $this->form }}
                <x-filament::actions :actions="$this->getFormActions()" class="form-actions" />
            </form>


        </div>
    </div>
</div>

<style>
    h3 {
        font-family: 'Inter', sans-serif;
        font-size: 150%;
        padding-bottom: 7%;
    }

    .login-container {
        display: flex;
        flex-direction: row;
        height: 100vh;
        width: 100%;
        font-family: 'Inter', sans-serif;
    }

    .login-left {
        flex: 2;
        background-color: #3B4BA6;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        flex-direction: column;
        text-align: center;
    }

    .login-right {
        flex: 1.2;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-box {
        display: grid;
        width: 100%;
        max-width: 80%;
        margin-bottom: 10%;
    }

    .login-logo {
        justify-self: center;
        width: 60%;
        min-width: 315px;
        margin-bottom: 14%;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .form-actions button {
        margin-top: 20px;
        width: 100%;
        background-color: #3B4BA6 !important;
        border: none;
        color: white !important;
        font-weight: 600;
        border-radius: 6px;
        padding: 10px 0;
        transition: background-color 0.2s ease;
    }

    .form-actions button:hover {
        background-color: #2F3D8A !important;
    }


    @media (max-width: 768px) {
        .login-container {
            flex-direction: column;
        }

        .login-left {
            display: none;
        }

        .login-right {
            flex: 1;
            width: 100%;
            height: 100vh;
        }
    }

    h2,
    h3,
    p,
    label,
    input,
    span {
        color: #000 !important;
        /* or white if preferred */
    }

    /* Keep contrast for dark backgrounds */
    .login-left h2,
    .login-left p {
        color: #fff !important;
    }

    .form-actions button span {
        color: #fff !important;
    }
</style>
