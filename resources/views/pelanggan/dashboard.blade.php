<x-layouts.dashboard title="Dashboard Pelanggan - PLN Bayar Listrik" guard="pelanggan" sidebarActive="dashboard">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Dashboard Pelanggan</h2>
        <p class="text-gray-600 mt-2">Selamat datang di panel pelanggan PLN Bayar Listrik</p>
    </div>

    <x-card title="Informasi Akun" class="mb-6 p-6 bg-white rounded-lg shadow-md">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-gray-500">Nama</p>
                <p class="font-semibold">{{ Auth::guard('pelanggan')->user()->nama_pelanggan }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Nomor KWH</p>
                <p class="font-semibold">{{ Auth::guard('pelanggan')->user()->nomor_kwh }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Alamat</p>
                <p class="font-semibold">{{ Auth::guard('pelanggan')->user()->alamat }}</p>
            </div>
        </div>
    </x-card>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <x-card title="Tagihan Saya" class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <p class="text-gray-600 mb-4">Lihat dan bayar tagihan listrik Anda.</p>
            <x-button href="{{ route('pelanggan.tagihans.index') }}">Lihat Tagihan</x-button>
        </x-card>
        <x-card title="Riwayat Pembayaran" class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <p class="text-gray-600 mb-4">Pantau riwayat pembayaran Anda.</p>
            <x-button href="{{ route('pelanggan.pembayarans.index') }}">Lihat Riwayat</x-button>
        </x-card>
    </div>
</x-layouts.dashboard>
