<x-layouts.dashboard title="Kelola Pelanggan - Admin" guard="web" sidebarActive="pelanggans">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Kelola Pelanggan</h2>
        <p class="text-gray-600 mt-2">Kelola data pelanggan PLN</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 rounded-lg p-4 mb-6">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <x-button href="{{ route('pelanggans.create') }}" class="mb-4">Tambah Pelanggan Baru</x-button>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full table-auto min-w-full border-collapse border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Nama</th>
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Nomor KWH</th>
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Alamat</th>
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Tarif</th>
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Username</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggans as $pelanggan)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 border border-gray-300">{{ $pelanggan->nama_pelanggan }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $pelanggan->nomor_kwh }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $pelanggan->alamat }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $pelanggan->tarif->daya ?? 'N/A' }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $pelanggan->username }}</td>
                            <td class="px-6 py-4 border border-gray-300">
                                <x-button href="{{ route('pelanggans.edit', $pelanggan) }}" class="mr-2 bg-yellow-600 hover:bg-yellow-700">Edit</x-button>
                                <form action="{{ route('pelanggans.destroy', $pelanggan) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" class="bg-red-600 hover:bg-red-700" onclick="return confirm('Yakin hapus pelanggan ini?')">Hapus</x-button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 border border-gray-300">
                                <i class="fas fa-users text-4xl mb-2"></i>
                                <div>Belum ada data pelanggan.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</x-layouts.dashboard>
