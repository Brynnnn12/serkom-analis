<x-layouts.dashboard title="Kelola Penggunaan - Admin" guard="web" sidebarActive="penggunaans">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Kelola Penggunaan Meteran</h2>
        <p class="text-gray-600 mt-2">Catat penggunaan meteran bulanan pelanggan</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 rounded-lg p-4 mb-6">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <x-button href="{{ route('penggunaans.create') }}" class="mb-4" variant="primary">Input Penggunaan Baru</x-button>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full table-auto min-w-full border-collapse border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Pelanggan</th>
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Bulan/Tahun</th>
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Meter Awal</th>
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Meter Akhir</th>
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Jumlah Meter</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Status Tagihan</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penggunaans as $penggunaan)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 border border-gray-300">{{ $penggunaan->pelanggan->nama_pelanggan ?? 'N/A' }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $penggunaan->bulan }}/{{ $penggunaan->tahun }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ number_format($penggunaan->meter_awal, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ number_format($penggunaan->meter_ahir, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ number_format($penggunaan->meter_ahir - $penggunaan->meter_awal, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 border border-gray-300">
                                @if($penggunaan->tagihan)
                                    <span class="px-2 py-1 rounded text-xs {{ $penggunaan->tagihan->status == 'Belum Bayar' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $penggunaan->tagihan->status }}
                                    </span>
                                @else
                                    <span class="text-gray-500">Tidak ada tagihan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 border border-gray-300">
                                <x-button href="{{ route('penggunaans.edit', $penggunaan) }}" variant="warning" class="mr-2">Edit</x-button>
                                <form action="{{ route('penggunaans.destroy', $penggunaan) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" variant="danger" onclick="return confirm('Yakin hapus penggunaan ini?')">Hapus</x-button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-500 border border-gray-300">
                                <i class="fas fa-tachometer-alt text-4xl mb-2"></i>
                                <div>Belum ada data penggunaan.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</x-layouts.dashboard>
