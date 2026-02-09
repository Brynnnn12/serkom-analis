{{-- Admin Sidebar Component --}}
@props(['active' => ''])

<aside class="sidebar-mobile fixed inset-y-0 left-0 z-50 w-72 bg-blue-900 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl lg:shadow-none border-r border-blue-800/50">
    <div class="p-6 flex items-center justify-between border-b border-blue-800/50">
        <div class="flex items-center space-x-3">
            <div class="bg-blue-600 p-2 rounded-lg shadow-inner">
                <i class="fas fa-user-shield text-xl text-white"></i>
            </div>
            <span class="text-xl font-bold tracking-wider uppercase">Portal Admin</span>
        </div>
        <button onclick="closeMobileMenu()" class="lg:hidden p-2 rounded-md hover:bg-blue-800 transition-colors">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto custom-scrollbar">
        @php
            $menus = [
                ['id' => 'dashboard', 'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard', 'route' => 'admin.dashboard'],
                ['id' => 'tarifs', 'icon' => 'fa-dollar-sign', 'label' => 'Kelola Tarif', 'route' => 'tarifs.index'],
                ['id' => 'users', 'icon' => 'fa-users-cog', 'label' => 'Kelola Admin', 'route' => 'users.index'],
                ['id' => 'pelanggans', 'icon' => 'fa-user-friends', 'label' => 'Kelola Pelanggan', 'route' => 'pelanggans.index'],
                ['id' => 'penggunaans', 'icon' => 'fa-bolt', 'label' => 'Input Penggunaan', 'route' => 'penggunaans.index'],
                ['id' => 'tagihans', 'icon' => 'fa-file-invoice-dollar', 'label' => 'Lihat Tagihan', 'route' => 'tagihans.index'],
                ['id' => 'pembayarans', 'icon' => 'fa-credit-card', 'label' => 'Proses Pembayaran', 'route' => 'pembayarans.index'],
            ];
        @endphp

        @foreach($menus as $menu)
            <a href="{{ route($menu['route']) }}"
               class="flex items-center px-4 py-3.5 rounded-xl transition-all duration-200 group {{ $active === $menu['id'] ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/50' : 'text-blue-200 hover:bg-blue-800/50 hover:text-white' }}">
                <div class="w-8 flex justify-center">
                    <i class="fas {{ $menu['icon'] }} text-lg transition-transform group-hover:scale-110"></i>
                </div>
                <span class="ml-3 font-medium">{{ $menu['label'] }}</span>
                @if($active === $menu['id'])
                    <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white shadow-[0_0_8px_white]"></span>
                @endif
            </a>
        @endforeach
    </nav>

    <div class="p-4 border-t border-blue-800/50 bg-blue-950/30 text-xs text-blue-400 text-center uppercase tracking-widest font-semibold">
        PLN Bayar Listrik v2.0
    </div>
</aside>
