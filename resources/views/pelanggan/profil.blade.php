<x-layouts.dashboard title="Profil Pelanggan - PLN Bayar Listrik" guard="pelanggan" sidebarActive="profil">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Profil Saya</h2>
        <p class="text-gray-600 mt-2">Informasi akun dan data pribadi Anda</p>
    </div>

    <x-card title="Informasi Pribadi" class="p-6 bg-white rounded-lg shadow-md">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="p-4 bg-gray-50 rounded-lg">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pelanggan</label>
                <p class="text-lg text-gray-900">{{ Auth::guard('pelanggan')->user()->nama_pelanggan }}</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-lg">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor KWH</label>
                <p class="text-lg text-gray-900">{{ Auth::guard('pelanggan')->user()->nomor_kwh }}</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-lg">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                <p class="text-lg text-gray-900">{{ Auth::guard('pelanggan')->user()->alamat }}</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-lg">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tarif</label>
                <p class="text-lg text-gray-900">{{ Auth::guard('pelanggan')->user()->tarif->daya ?? 'N/A' }} VA - Rp {{ number_format(Auth::guard('pelanggan')->user()->tarif->tarifperkwh ?? 0) }}/kWh</p>
            </div>
        </div>
    </x-card>
</x-layouts.dashboard>
