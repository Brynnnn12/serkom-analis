<x-layouts.dashboard title="Detail Tarif - Admin" guard="web" sidebarActive="tarifs">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Detail Tarif</h2>
        <p class="text-gray-600 mt-2">Informasi lengkap data tarif listrik</p>
    </div>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">ID Tarif:</strong>
                <p class="text-gray-900">{{ $tarif->id_tarif }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Daya:</strong>
                <p class="text-gray-900">{{ $tarif->daya }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Tarif per kWh:</strong>
                <p class="text-gray-900">Rp {{ number_format($tarif->tarifperkwh) }}</p>
            </div>
        </div>

        <div class="flex items-center justify-between mt-6">
            <x-button href="{{ route('tarifs.index') }}" class="bg-gray-600 hover:bg-gray-700">Kembali</x-button>
            <x-button href="{{ route('tarifs.edit', $tarif->id_tarif) }}">Edit</x-button>
        </div>
    </x-card>
</x-layouts.dashboard>
