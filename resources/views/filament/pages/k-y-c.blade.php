@vite('resources/css/app.css')
<x-filament-panels::page>
    {{-- Page content --}}

    {{-- Status Environment --}}
    <div class="w-full">
        <div class="bg-white shadow rounded-xl p-6">
            <p class="mb-2">
                Your current ENVIRONMENT is :
                <b class="font-semibold">{{ env('SATUSEHAT_ENV') }}</b>
            </p>

            @if (isset($token))
                <p class="mb-2">
                    Your current token is :
                    <b class="font-semibold">{{ $token }}</b>
                </p>
            @endif


            <div class="w-full mt-4">
                <button onclick="window.open('{{ route('kyc_url') }}', '_blank')"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Buka di tab baru
                </button>
            </div>



</x-filament-panels::page>
