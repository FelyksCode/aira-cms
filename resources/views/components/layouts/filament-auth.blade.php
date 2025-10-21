@import "tailwindcss";

@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="min-h-screen flex flex-col bg-gradient-to-b from-white to-sky-50">

    {{-- Top navbar --}}
    <header class="w-full bg-white shadow-[0_4px_12px_rgba(0,0,0,0.06)] h-20 flex items-center relative z-50">
        <div class="absolute left-6 top-1/2 -translate-y-1/2">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                <x-filament-panels::logo class="h-10 w-auto" />
                <span class="font-semibold text-lg text-slate-800">UMN Cancer Society</span>
            </a>
        </div>

        <div class="w-full flex justify-center">
            @php
                $menuItems = [
                    ['label' => 'Diagnosis', 'path' => '/diagnosis'],
                    ['label' => 'Prognosis', 'path' => '/prognosis'],
                    ['label' => 'Treatment', 'path' => '/treatment'],
                    ['label' => 'Informasi', 'path' => '/information'],
                ];
            @endphp

            <ul class="flex gap-16 text-xl font-semibold">
                @foreach ($menuItems as $item)
                    @php $isActive = request()->is(ltrim($item['path'], '/')); @endphp
                    <li>
                        <a href="{{ url($item['path']) }}"
                            class="transition-colors duration-200 {{ $isActive ? 'font-bold text-[#181852]' : 'font-normal text-[#212129]' }} hover:text-[#181852]">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </header>

    {{-- Page slot (centered) --}}
    <main class="flex-1 flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-[#1b1677] text-white py-10">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 px-6 text-sm">
            <div>
                <h3 class="font-semibold mb-2">Helpdesk</h3>
                <p>Gedung A, Lantai 5 ruang<br>Jl. Scientia Boulevard, Gading Serpong<br>Tangerang, Banten 15811</p>
            </div>
            <div>
                <h3 class="font-semibold mb-2">Contact</h3>
                <p><strong>Phone:</strong> (021) 1234 567 ext.3518<br><strong>Email:</strong> AIRA@umn.ac.id</p>
            </div>
            <div>
                <h3 class="font-semibold mb-2">More</h3>
                <p>Additional links or info here.</p>
            </div>
        </div>

        <div class="mt-8 text-center text-xs text-slate-200">
            © {{ date('Y') }} UMN Cancer Society. All rights reserved.
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
