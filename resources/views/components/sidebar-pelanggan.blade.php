{{-- Pelanggan Sidebar Component --}}
@props(['active' => ''])

<div class="sidebar-mobile bg-blue-800 text-white w-64 min-h-screen p-4 fixed lg:static inset-y-0 left-0 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out lg:flex lg:flex-col">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-center flex-1">Menu Pelanggan</h2>
        <button onclick="closeMobileMenu()" class="lg:hidden text-white hover:text-gray-200">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
    <nav class="space-y-2 flex-1">
        <a href="{{ route('pelanggan.dashboard') }}"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 {{ $active === 'dashboard' ? 'bg-green-600' : 'hover:bg-green-700' }}">
            <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
        </a>
        <a href="{{ route('pelanggan.tagihans.index') }}"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 {{ $active === 'tagihans' ? 'bg-green-600' : 'hover:bg-green-700' }}">
            <i class="fas fa-file-invoice-dollar mr-3"></i>Tagihan Saya
        </a>
        <a href="{{ route('pelanggan.pembayarans.index') }}"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 {{ $active === 'pembayarans' ? 'bg-green-600' : 'hover:bg-green-700' }}">
            <i class="fas fa-credit-card mr-3"></i>Riwayat Pembayaran
        </a>
        <a href="{{ route('pelanggan.profil') }}"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 {{ $active === 'profil' ? 'bg-green-600' : 'hover:bg-green-700' }}">
            <i class="fas fa-user mr-3"></i>Profil Saya
        </a>
    </nav>
</div>
