<x-filament-panels::page>
    {{-- Page content --}}

    {{-- Status Environment --}}
    <div class="container">
        <div class="card">
            <p>
                Your current ENVIRONMENT is:
                <b>{{ env('SATUSEHAT_ENV') }}</b>
            </p>

            @if (isset($token))
                <p>
                    Your current token is:
                    <b>{{ $token }}</b>
                </p>
            @endif

            <div class="button-wrapper">
                <button onclick="window.open('{{ route('kyc_url') }}', '_blank')" class="btn">
                    Buka di tab baru
                </button>
            </div>
        </div>
    </div>

    {{-- PAGE CSS STYLES --}}
    <style>
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 16px;
        }

        .card {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 24px;
        }

        .card p {
            margin-bottom: 12px;
            font-size: 14px;
        }

        .card b {
            font-weight: 600;
        }

        .button-wrapper {
            margin-top: 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            background-color: #16a34a;
            /* green-600 */
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.2s ease;
        }

        .btn:hover {
            background-color: #15803d;
            /* green-700 */
        }

        .btn:focus {
            outline: none;
            box-shadow: 0 0 0 2px #22c55e;
            /* green-500 ring */
        }
    </style>




</x-filament-panels::page>
