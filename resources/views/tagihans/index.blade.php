<x-layouts.dashboard title="Kelola Tagihan - {{ $isAdmin ? 'Admin' : 'Pelanggan' }}" guard="{{ $isAdmin ? 'web' : 'pelanggan' }}" sidebarActive="tagihans">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Kelola Tagihan</h2>
        <p class="text-gray-600 mt-2">{{ $isAdmin ? 'Pantau dan kelola tagihan pelanggan' : 'Lihat dan bayar tagihan listrik Anda' }}</p>
    </div>

    @if(!$isAdmin)
        <!-- Summary Cards untuk Pelanggan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <x-card class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <i class="fas fa-file-invoice-dollar text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Total Tagihan</h3>
                        <p class="text-2xl font-bold">{{ $tagihans->count() }}</p>
                    </div>
                </div>
            </x-card>

            <x-card class="bg-gradient-to-r from-red-500 to-red-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <i class="fas fa-exclamation-triangle text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Belum Bayar</h3>
                        <p class="text-2xl font-bold">{{ $tagihans->where('status', 'Belum Bayar')->count() }}</p>
                    </div>
                </div>
            </x-card>

            <x-card class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <i class="fas fa-money-bill-wave text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Total Hutang</h3>
                        <p class="text-2xl font-bold">Rp {{ number_format($tagihans->where('status', 'Belum Bayar')->sum(function($tagihan) { return $tagihan->jumlah_meter * ($tagihan->pelanggan->tarif->tarifperkwh ?? 0); }), 0, ',', '.') }}</p>
                    </div>
                </div>
            </x-card>
        </div>
    @endif

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full table-auto min-w-full border-collapse border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200">
                        @if($isAdmin)
                            <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Pelanggan</th>
                        @endif
                        <th class="px-6 py-3 text-left border border-gray-300">Bulan/Tahun</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Jumlah Meter</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Total Tagihan</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Status</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tagihans as $tagihan)
                        <tr class="border-b hover:bg-gray-50 {{ $tagihan->status == 'Belum Bayar' ? 'bg-red-50' : 'bg-green-50' }}">
                            @if($isAdmin)
                                <td class="px-6 py-4 border border-gray-300">{{ $tagihan->pelanggan->nama_pelanggan ?? 'N/A' }}</td>
                            @endif
                            <td class="px-6 py-4 border border-gray-300">
                                <div class="font-medium">{{ date('F', mktime(0, 0, 0, $tagihan->bulan, 1)) }}</div>
                                <div class="text-sm text-gray-500">{{ $tagihan->tahun }}</div>
                            </td>
                            <td class="px-6 py-4 border border-gray-300">
                                <div class="font-medium">{{ number_format($tagihan->jumlah_meter, 0, ',', '.') }} kWh</div>
                            </td>
                            <td class="px-6 py-4 border border-gray-300">
                                <div class="font-semibold text-blue-600">Rp {{ number_format($tagihan->jumlah_meter * ($tagihan->pelanggan->tarif->tarifperkwh ?? 0), 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 border border-gray-300">
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $tagihan->status == 'Belum Bayar' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    <i class="fas {{ $tagihan->status == 'Belum Bayar' ? 'fa-times-circle' : 'fa-check-circle' }} mr-1"></i>
                                    {{ $tagihan->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 border border-gray-300">
                                <x-button href="{{ $isAdmin ? route('tagihans.show', $tagihan) : route('pelanggan.tagihans.show', $tagihan) }}" variant="primary">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </x-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $isAdmin ? 6 : 5 }}" class="px-6 py-8 text-center text-gray-500 border border-gray-300">
                                <i class="fas fa-inbox text-4xl mb-2"></i>
                                <div>Belum ada data tagihan.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</x-layouts.dashboard>
