{{-- Pelanggan Sidebar Component --}}
@props(['active' => ''])

<aside class="sidebar-mobile fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-2xl lg:shadow-none">
    <div class="p-6 flex items-center justify-between border-b border-slate-800">
        <div class="flex items-center space-x-3">
            <div class="bg-emerald-500 p-2 rounded-lg shadow-lg">
                <i class="fas fa-home text-xl text-white"></i>
            </div>
            <span class="text-xl font-bold tracking-tight">Pelanggan Area</span>
        </div>
        <button onclick="closeMobileMenu()" class="lg:hidden p-2 rounded-md hover:bg-slate-800 transition-colors">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        @php
            $menus = [
                ['id' => 'dashboard', 'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard', 'route' => 'pelanggan.dashboard'],
                ['id' => 'tagihans', 'icon' => 'fa-file-invoice-dollar', 'label' => 'Tagihan Saya', 'route' => 'pelanggan.tagihans.index'],
                ['id' => 'pembayarans', 'icon' => 'fa-history', 'label' => 'Riwayat Bayar', 'route' => 'pelanggan.pembayarans.index'],
                ['id' => 'profil', 'icon' => 'fa-user-circle', 'label' => 'Profil Saya', 'route' => 'pelanggan.profil'],
            ];
        @endphp

        @foreach($menus as $menu)
            <a href="{{ route($menu['route']) }}"
               class="flex items-center px-4 py-3.5 rounded-xl transition-all duration-300 group {{ $active === $menu['id'] ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-900/40' : 'text-slate-400 hover:bg-slate-800 hover:text-emerald-400' }}">
                <div class="w-8 flex justify-center text-lg">
                    <i class="fas {{ $menu['icon'] }} transition-transform group-hover:rotate-12"></i>
                </div>
                <span class="ml-3 font-semibold">{{ $menu['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="m-4 p-4 bg-slate-800/50 rounded-2xl border border-slate-700">
        <p class="text-xs text-slate-400 mb-2">Butuh Bantuan?</p>
        <a href="#" class="text-xs text-emerald-400 hover:underline flex items-center">
            <i class="fas fa-headset mr-2"></i> Hubungi CS
        </a>
    </div>
</aside>
