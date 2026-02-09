<x-layouts.dashboard title="Detail Pelanggan - Admin" guard="web" sidebarActive="pelanggans">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Detail Pelanggan</h2>
        <p class="text-gray-600 mt-2">Informasi lengkap data pelanggan PLN</p>
    </div>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">ID Pelanggan:</strong>
                <p class="text-gray-900">{{ $pelanggan->id_pelanggan }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Nomor KWH:</strong>
                <p class="text-gray-900">{{ $pelanggan->nomor_kwh }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Nama Pelanggan:</strong>
                <p class="text-gray-900">{{ $pelanggan->nama_pelanggan }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Username:</strong>
                <p class="text-gray-900">{{ $pelanggan->username }}</p>
            </div>
            <div class="mb-4 md:col-span-2">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Alamat:</strong>
                <p class="text-gray-900">{{ $pelanggan->alamat }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Tarif:</strong>
                <p class="text-gray-900">{{ $pelanggan->tarif->daya }} VA - Rp {{ number_format($pelanggan->tarif->tarifperkwh) }}</p>
            </div>
        </div>

        <div class="flex items-center justify-between mt-6">
            <x-button href="{{ route('pelanggans.index') }}" class="bg-gray-600 hover:bg-gray-700">Kembali</x-button>
            <x-button href="{{ route('pelanggans.edit', $pelanggan->id_pelanggan) }}">Edit</x-button>
        </div>
    </x-card>
</x-layouts.dashboard>
