{{-- Dashboard Layout Component --}}
@props(['title', 'guard' => 'web', 'sidebarActive' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard - PLN Bayar Listrik' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen font-sans antialiased text-gray-900">

    <div id="mobile-menu-overlay"
         class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity duration-300 opacity-0"
         onclick="closeMobileMenu()"></div>

    <div class="flex min-h-screen">
        {{-- Sidebar Section --}}
        <aside class="z-50">
            @if($guard === 'web')
                <x-sidebar-admin :active="$sidebarActive" />
            @elseif($guard === 'pelanggan')
                <x-sidebar-pelanggan :active="$sidebarActive" />
            @endif
        </aside>

        {{-- Main Content Section --}}
        <div class="flex-1 flex flex-col min-w-0 lg:pl-72 transition-all duration-300">

            {{-- Navbar --}}
            <header class="sticky top-0 z-30">
                <x-navbar :user="auth()->user()" :guard="$guard" />
            </header>

            {{-- Slot Content --}}
            <main class="flex-1 px-4 lg:px-6 pb-12">
                <div class="container mx-auto">
                    {{ $slot }}
                </div>
            </main>

            {{-- Footer --}}
            <x-footer />
        </div>
    </div>

    <script>
        /**
         * Logic untuk Mobile Menu
         * Pastikan di Sidebar Component Anda memiliki class 'sidebar-mobile'
         */
        const getElements = () => ({
            sidebar: document.querySelector('.sidebar-mobile'),
            overlay: document.getElementById('mobile-menu-overlay')
        });

        function toggleMobileMenu() {
            const { sidebar, overlay } = getElements();

            if (sidebar && overlay) {
                const isOpen = sidebar.classList.contains('translate-x-0');

                if (isOpen) {
                    closeMobileMenu();
                } else {
                    sidebar.classList.replace('-translate-x-full', 'translate-x-0');
                    overlay.classList.remove('hidden');
                    setTimeout(() => overlay.classList.add('opacity-100'), 10);
                    document.body.classList.add('overflow-hidden');
                }
            }
        }

        function closeMobileMenu() {
            const { sidebar, overlay } = getElements();

            if (sidebar && overlay) {
                sidebar.classList.replace('translate-x-0', '-translate-x-full');
                overlay.classList.remove('opacity-100');
                document.body.classList.remove('overflow-hidden');

                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300); // Sesuai durasi transisi
            }
        }

        // Handle link clicks inside mobile sidebar
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarLinks = document.querySelectorAll('.sidebar-mobile a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', closeMobileMenu);
            });
        });
    </script>
</body>
</html>
