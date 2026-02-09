{{-- Admin Sidebar Component --}}
@props(['active' => ''])

<div class="sidebar-mobile bg-blue-800 text-white w-64 min-h-screen p-4 fixed lg:static inset-y-0 left-0 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out lg:flex lg:flex-col">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-center flex-1">Menu Admin</h2>
        <button onclick="closeMobileMenu()" class="lg:hidden text-white hover:text-gray-200">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
    <nav class="space-y-2 flex-1">
        <a href="{{ route('admin.dashboard') }}"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 {{ $active === 'dashboard' ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
            <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
        </a>
        <a href="{{ route('tarifs.index') }}"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 {{ $active === 'tarifs' ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
            <i class="fas fa-dollar-sign mr-3"></i>Kelola Tarif
        </a>
        <a href="{{ route('users.index') }}"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 {{ $active === 'users' ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
            <i class="fas fa-users mr-3"></i>Kelola Admin
        </a>
        <a href="{{ route('pelanggans.index') }}"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 {{ $active === 'pelanggans' ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
            <i class="fas fa-user-friends mr-3"></i>Kelola Pelanggan
        </a>
        <a href="{{ route('penggunaans.index') }}"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 {{ $active === 'penggunaans' ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
            <i class="fas fa-chart-line mr-3"></i>Input Penggunaan
        </a>
        <a href="{{ route('tagihans.index') }}"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 {{ $active === 'tagihans' ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
            <i class="fas fa-file-invoice-dollar mr-3"></i>Lihat Tagihan
        </a>
        <a href="{{ route('pembayarans.index') }}"
           class="block py-4 px-5 rounded-lg text-lg transition-colors duration-200 {{ $active === 'pembayarans' ? 'bg-blue-600' : 'hover:bg-blue-700' }}">
            <i class="fas fa-credit-card mr-3"></i>Proses Pembayaran
        </a>
    </nav>
</div>
