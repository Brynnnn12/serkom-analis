<x-layouts.dashboard title="Kelola Tarif - Admin" guard="web" sidebarActive="tarifs">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Kelola Tarif</h2>
        <p class="text-gray-600 mt-2">Atur tarif listrik berdasarkan daya</p>
    </div>

    @if(session('success'))
        <x-card class="bg-green-100 border border-green-400 mb-4 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </x-card>
    @endif

    <x-button href="{{ route('tarifs.create') }}" class="mb-4">Tambah Tarif Baru</x-button>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full table-auto min-w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Daya</th>
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Tarif per kWh</th>
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Aksi</th>
                    </tr>
                </thead>
            <tbody>
                @forelse($tarifs as $tarif)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 border border-gray-300">{{ $tarif->daya }}</td>
                        <td class="px-6 py-4 border border-gray-300">Rp {{ number_format($tarif->tarifperkwh, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 border border-gray-300">
                            <x-button href="{{ route('tarifs.edit', $tarif) }}" variant="warning" class="mr-2">Edit</x-button>
                            <form action="{{ route('tarifs.destroy', $tarif) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" variant="danger" onclick="return confirm('Yakin hapus tarif ini?')">Hapus</x-button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500 border border-gray-300">
                            <i class="fas fa-bolt text-4xl mb-2"></i>
                            <div>Belum ada data tarif.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-card>
</x-layouts.dashboard>
