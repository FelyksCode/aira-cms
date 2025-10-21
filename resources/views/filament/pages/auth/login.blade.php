<div class="root-wrapper">

    {{-- Navbar --}}
    <nav class="navbar">
        <!-- Logo -->
        <div class="logo-wrapper">
            <a href="/">
                <img src="{{ asset('logo.PNG') }}" alt="Logo" class="logo">
            </a>
        </div>

        <!-- Burger button -->
        <button id="burger" class="burger">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- Menu -->
        <div class="menu-wrapper">
            <ul class="menu-list">
                <li><a href="/diagnosis">Diagnosis</a></li>
                <li><a href="/prognosis">Prognosis</a></li>
                <li><a href="/treatment">Treatment</a></li>
                <li><a href="/information">Informasi</a></li>
            </ul>
        </div>
    </nav>

    {{-- Content --}}
    <div class="content-wrapper">
        <x-filament-panels::page.simple heading="">
            <form wire:submit="authenticate">
                {{ $this->form }}
                <x-filament::actions :actions="$this->getFormActions()" class="form-actions" />
            </form>
        </x-filament-panels::page.simple>
    </div>

    {{-- Footer --}}
    <footer class="custom-footer">
        <div class="footer-grid">
            <!-- Helpdesk -->
            <div>
                <h3>Helpdesk</h3>
                <p class="link">
                    Gedung A, Lantai 5 ruang <br>
                    Jl. Scientia Boulevard, Gading Serpong <br>
                    Tangerang, Banten 15811
                </p>
            </div>

            <!-- Contact -->
            <div>
                <h3>Contact</h3>
                <p>
                    <span class="font-semibold">Phone</span><br>
                    <span class="link">(021) 1234 567 ext.3518</span>
                </p>
                <p class="mt-2">
                    <span class="font-semibold">Email</span><br>
                    <span class="link">AIRA@umn.ac.id</span>
                </p>
                <p class="mt-2 link">
                    Whatsapp (Message Only): 0822-1234-5678
                </p>
            </div>

            <!-- More -->
            <div>
                <h3>More</h3>
                <p class="link">Lorem ipsum</p>
            </div>
        </div>

        <!-- Background Cityscape -->
        <div class="footer-bg">
            <img src="/assets/footer-city.png" alt="Cityscape">
        </div>
    </footer>


</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const burger = document.getElementById("burger");
        const menu = document.querySelector(".menu-wrapper");

        burger.addEventListener("click", () => {
            menu.classList.toggle("active");
        });
    });
</script>

@push('styles')
    <style>
        /* .fi-simple-header {
                                    display: none;
                                } */


        .root-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            justify-self: center;
            background: linear-gradient(to bottom, #8ab6e3, #eef2ff);
        }

        /* Navbar */
        .navbar {
            width: 100%;
            height: 80px;
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 24px;
            position: relative;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            z-index: 50;
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
        }

        .logo {
            height: 48px;
            width: auto;
            cursor: pointer;
        }

        /* Menu */
        .menu-wrapper {
            display: flex;
        }

        .menu-list {
            display: flex;
            gap: 64px;
            list-style: none;
            margin: 0;
            padding: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .menu-list li a {
            text-decoration: none;
            color: #212129;
            transition: color 0.2s ease;
        }

        .menu-list li a:hover {
            color: #181852;
        }

        /* Burger */
        .burger {
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .burger span {
            width: 24px;
            height: 3px;
            background: #181852;
            margin: 3px 0;
            display: block;
        }

        /* Content */
        .content-wrapper {
            flex: 1;
            padding-top: 20vh;
            padding-bottom: 20vh;

        }

        .form-actions {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .fi-simple-page main {
            background: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        /* Footer */
        .custom-footer {
            position: relative;
            width: 100%;
            background-color: #152e66;
            color: white;
            padding: 3rem 1.5rem;
            /* px-6 py-12 equivalent */
            box-sizing: border-box;
        }

        /* Grid layout */
        .footer-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            position: relative;
            z-index: 10;
        }

        /* Medium screens */
        @media (min-width: 768px) {
            .footer-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Headings */
        .custom-footer h3 {
            font-weight: bold;
            font-size: 1.125rem;
            /* text-lg */
            margin-bottom: 0.75rem;
        }

        /* Links */
        .link {
            cursor: pointer;
            text-decoration: none;
        }

        .link:hover {
            text-decoration: underline;
        }

        /* Font weight helper */
        .font-semibold {
            font-weight: 600;
        }

        /* Margin-top helper */
        .mt-2 {
            margin-top: 0.5rem;
        }

        /* Background image */
        .footer-bg {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .footer-bg img {
            width: 100%;
            object-fit: cover;
            display: block;
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .menu-wrapper {
                position: absolute;
                top: 80px;
                left: 0;
                width: 100%;
                background: white;
                display: none;
                flex-direction: column;
                align-items: center;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            .menu-wrapper.active {
                display: flex;
            }

            .menu-list {
                flex-direction: column;
                gap: 16px;
                padding: 16px 0;
            }

            .burger {
                display: flex;
            }
        }
    </style>
@endpush
