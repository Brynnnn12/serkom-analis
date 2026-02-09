<x-layouts.dashboard title="Dashboard Admin - PLN Bayar Listrik" guard="web" sidebarActive="dashboard">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Dashboard Admin</h2>
        <p class="text-gray-600 mt-2">Selamat datang di panel admin PLN Bayar Listrik</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <x-card title="Kelola Tarif" class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <p class="text-gray-600 mb-4">Atur tarif listrik berdasarkan daya.</p>
            <x-button href="{{ route('tarifs.index') }}">Kelola Tarif</x-button>
        </x-card>
        <x-card title="Kelola Admin" class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <p class="text-gray-600 mb-4">Kelola akun admin dan petugas.</p>
            <x-button href="{{ route('users.index') }}">Kelola Admin</x-button>
        </x-card>
        <x-card title="Input Penggunaan" class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <p class="text-gray-600 mb-4">Catat penggunaan meteran bulanan.</p>
            <x-button href="{{ route('penggunaans.index') }}">Input Penggunaan</x-button>
        </x-card>
        <x-card title="Lihat Tagihan" class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <p class="text-gray-600 mb-4">Pantau tagihan yang belum dibayar.</p>
            <x-button href="{{ route('tagihans.index') }}">Lihat Tagihan</x-button>
        </x-card>
        <x-card title="Proses Pembayaran" class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <p class="text-gray-600 mb-4">Konfirmasi pembayaran dari pelanggan.</p>
            <x-button href="{{ route('pembayarans.index') }}">Proses Pembayaran</x-button>
        </x-card>
        <x-card title="Kelola Pelanggan" class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <p class="text-gray-600 mb-4">Kelola data pelanggan PLN.</p>
            <x-button href="{{ route('pelanggans.index') }}">Kelola Pelanggan</x-button>
        </x-card>
    </div>
</x-layouts.dashboard>
