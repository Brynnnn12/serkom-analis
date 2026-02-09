{{-- Dashboard Layout Component --}}
@props(['title', 'guard' => 'web', 'sidebarActive' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard - PLN Bayar Listrik' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Mobile menu overlay -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden" onclick="closeMobileMenu()"></div>

    <div class="flex min-h-screen">
        @if($guard === 'web')
            <x-sidebar-admin :active="$sidebarActive" />
        @elseif($guard === 'pelanggan')
            <x-sidebar-pelanggan :active="$sidebarActive" />
        @endif

        <div class="flex-1 flex flex-col lg:ml-0">
            <x-navbar :user="auth()->user()" :guard="$guard" />

            <main class="flex-1 p-4 lg:p-8">
                {{ $slot }}
            </main>

            <x-footer />
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const sidebar = document.querySelector('.sidebar-mobile');
            const overlay = document.getElementById('mobile-menu-overlay');

            if (sidebar && overlay) {
                sidebar.classList.toggle('translate-x-0');
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        }

        function closeMobileMenu() {
            const sidebar = document.querySelector('.sidebar-mobile');
            const overlay = document.getElementById('mobile-menu-overlay');

            if (sidebar && overlay) {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.add('hidden');
            }
        }

        // Close mobile menu when clicking on a link
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLinks = document.querySelectorAll('.sidebar-mobile a');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', closeMobileMenu);
            });
        });
    </script>
</body>
</html>
