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
                <li><a href="/admin/login" class="login-btn">Login</a></li>
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
        const menuLinks = document.querySelectorAll(".menu-list li a");

        burger.addEventListener("click", () => {
            menu.classList.toggle("active");
            burger.classList.toggle("active");
        });

        // Close menu when clicking a link
        menuLinks.forEach(link => {
            link.addEventListener("click", () => {
                menu.classList.remove("active");
                burger.classList.remove("active");
            });
        });

        // Close menu when clicking outside
        document.addEventListener("click", (e) => {
            if (!menu.contains(e.target) && !burger.contains(e.target) && menu.classList.contains("active")) {
                menu.classList.remove("active");
                burger.classList.remove("active");
            }
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
            background: linear-gradient(135deg, #8ab6e3, #4a90e2, #6c63ff);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            position: relative;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Add animated background particles */
        .root-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(255,255,255,0.1) 0%, transparent 60%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
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
            z-index: 1000;
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

        .login-btn {
            background: #4a90e2;
            color: white !important;
            padding: 8px 24px;
            border-radius: 50px;
            transition: all 0.3s ease !important;
        }

        .login-btn:hover {
            background: #357abd;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 144, 226, 0.3);
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
            padding-top: 10vh;
            padding-bottom: 10vh;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            position: relative;
        }

        .form-actions {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .fi-simple-page main {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Form styling */
        .fi-input-wrapper {
            margin-bottom: 1.5rem;
        }

        .fi-input {
            transition: all 0.3s ease;
            border-radius: 0.5rem !important;
        }

        .fi-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .fi-btn {
            transition: all 0.3s ease;
            transform: scale(1);
            padding: 0.75rem 2rem !important;
        }

        .fi-btn:hover {
            transform: scale(1.05);
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
                position: fixed;
                top: 80px;
                left: 0;
                width: 100%;
                height: 0;
                background: rgba(255, 255, 255, 0.98);
                opacity: 0;
                visibility: hidden;
                display: flex;
                flex-direction: column;
                align-items: center;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease-in-out;
                overflow: hidden;
                backdrop-filter: blur(10px);
                z-index: 999;
            }

            .menu-wrapper.active {
                height: auto;
                opacity: 1;
                visibility: visible;
                padding: 20px 0;
            }

            .menu-list {
                flex-direction: column;
                gap: 24px;
                padding: 16px 0;
                opacity: 0;
                transform: translateY(-20px);
                transition: all 0.3s ease-in-out;
            }

            .menu-wrapper.active .menu-list {
                opacity: 1;
                transform: translateY(0);
            }

            .menu-list li a {
                font-size: 18px;
                display: block;
                padding: 8px 24px;
                width: 100%;
                text-align: center;
                transition: all 0.3s ease;
            }

            .menu-list li a:hover {
                background: rgba(24, 24, 82, 0.1);
                transform: scale(1.05);
            }

            .menu-list li .login-btn {
                text-align: center;
            }

            .menu-list li .login-btn:hover {
                background: #357abd;
            }

            .burger {
                display: flex;
                z-index: 60;
            }

            /* Burger animation */
            .burger span {
                transition: all 0.3s ease-in-out;
            }

            .burger.active span:nth-child(1) {
                transform: rotate(45deg) translate(6px, 6px);
            }

            .burger.active span:nth-child(2) {
                opacity: 0;
            }

            .burger.active span:nth-child(3) {
                transform: rotate(-45deg) translate(6px, -6px);
            }
        }
    </style>
@endpush
