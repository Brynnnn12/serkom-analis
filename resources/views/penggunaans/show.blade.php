<x-layouts.dashboard title="Detail Penggunaan - Admin" guard="web" sidebarActive="penggunaans">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Detail Penggunaan</h2>
        <p class="text-gray-600 mt-2">Informasi lengkap data penggunaan listrik</p>
    </div>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">ID Penggunaan:</strong>
                <p class="text-gray-900">{{ $penggunaan->id_penggunaan }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Pelanggan:</strong>
                <p class="text-gray-900">{{ $penggunaan->pelanggan->nama_pelanggan }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Bulan:</strong>
                <p class="text-gray-900">{{ $penggunaan->bulan }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Tahun:</strong>
                <p class="text-gray-900">{{ $penggunaan->tahun }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Meter Awal:</strong>
                <p class="text-gray-900">{{ $penggunaan->meter_awal }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Meter Akhir:</strong>
                <p class="text-gray-900">{{ $penggunaan->meter_ahir }}</p>
            </div>
        </div>

        <div class="flex items-center justify-between mt-6">
            <x-button href="{{ route('penggunaans.index') }}" variant="secondary">Kembali</x-button>
            <x-button href="{{ route('penggunaans.edit', $penggunaan->id_penggunaan) }}">Edit</x-button>
        </div>
    </x-card>
</x-layouts.dashboard>
