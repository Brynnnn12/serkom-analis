<x-layouts.dashboard title="Kelola Pembayaran - {{ $isAdmin ? 'Admin' : 'Pelanggan' }}" guard="{{ $isAdmin ? 'web' : 'pelanggan' }}" sidebarActive="pembayarans">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Riwayat Pembayaran</h2>
        <p class="text-gray-600 mt-2">{{ $isAdmin ? 'Pantau pembayaran pelanggan' : 'Riwayat pembayaran Anda' }}</p>
    </div>

    @if(!$isAdmin)
        <!-- Summary Cards untuk Pelanggan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <x-card class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <i class="fas fa-receipt text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Total Pembayaran</h3>
                        <p class="text-2xl font-bold">{{ $pembayarans->count() }}</p>
                    </div>
                </div>
            </x-card>

            <x-card class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <i class="fas fa-money-bill-wave text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Total Dibayar</h3>
                        <p class="text-2xl font-bold">Rp {{ number_format($pembayarans->sum('total_bayar'), 0, ',', '.') }}</p>
                    </div>
                </div>
            </x-card>

            <x-card class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <i class="fas fa-calendar-alt text-3xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-semibold">Pembayaran Terakhir</h3>
                        <p class="text-sm">{{ $pembayarans->first() ? \Carbon\Carbon::parse($pembayarans->first()->tanggal_pembayaran)->format('d/m/Y') : 'Belum ada' }}</p>
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
                            <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Petugas</th>
                        @endif
                        <th class="px-6 py-3 text-left border border-gray-300">Tanggal Bayar</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Periode</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Total Bayar</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayarans as $pembayaran)
                        <tr class="border-b hover:bg-gray-50 bg-green-50">
                            @if($isAdmin)
                                <td class="px-6 py-4 border border-gray-300">{{ $pembayaran->tagihan->pelanggan->nama_pelanggan ?? 'N/A' }}</td>
                                <td class="px-6 py-4 border border-gray-300">{{ $pembayaran->user->nama_admin ?? 'N/A' }}</td>
                            @endif
                            <td class="px-6 py-4 border border-gray-300">
                                <div class="font-medium">{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 border border-gray-300">
                                <div class="font-medium">{{ date('F', mktime(0, 0, 0, $pembayaran->bulan_bayar, 1)) }}</div>
                                <div class="text-sm text-gray-500">{{ $pembayaran->tahun_bayar }}</div>
                            </td>
                            <td class="px-6 py-4 border border-gray-300">
                                <div class="font-semibold text-green-600">Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 border border-gray-300">
                                <x-button href="{{ $isAdmin ? route('pembayarans.show', $pembayaran) : route('pelanggan.pembayarans.show', $pembayaran) }}" variant="primary">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </x-button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $isAdmin ? 6 : 4 }}" class="px-6 py-8 text-center text-gray-500 border border-gray-300">
                                <i class="fas fa-receipt text-4xl mb-2"></i>
                                <div>Belum ada riwayat pembayaran.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</x-layouts.dashboard>
