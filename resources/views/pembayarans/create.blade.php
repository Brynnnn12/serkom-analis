<x-layouts.dashboard title="Proses Pembayaran - Admin" guard="web" sidebarActive="pembayarans">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Proses Pembayaran</h2>
        <p class="text-gray-600 mt-2">Konfirmasi pembayaran dari pelanggan</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 rounded-lg p-4 mb-6">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 rounded-lg p-4 mb-6">
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Form Pencarian Pelanggan -->
    <x-card class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h3 class="text-lg font-semibold mb-4">Cari Tagihan Pelanggan</h3>
        <form method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <label for="id_pelanggan" class="block text-gray-700 text-sm font-semibold mb-2">ID Pelanggan</label>
                <input type="text" id="id_pelanggan" name="id_pelanggan" value="{{ request('id_pelanggan') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                       placeholder="Masukkan ID Pelanggan" required>
            </div>
            <div class="flex items-end">
                <x-button type="submit" class="w-full sm:w-auto">Cari Tagihan</x-button>
            </div>
        </form>
    </x-card>

    @if($pelanggan && $tagihans->count() > 0)
        <!-- Info Pelanggan -->
        <x-card class="p-6 bg-white rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-semibold mb-4 text-blue-600">Informasi Pelanggan</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <p><strong>Nama:</strong> {{ $pelanggan->nama_pelanggan }}</p>
                    <p><strong>ID Pelanggan:</strong> {{ $pelanggan->id_pelanggan }}</p>
                </div>
                <div>
                    <p><strong>Nomor KWH:</strong> {{ $pelanggan->nomor_kwh }}</p>
                    <p><strong>Alamat:</strong> {{ $pelanggan->alamat }}</p>
                </div>
                <div>
                    <p><strong>Tarif:</strong> Rp {{ number_format($pelanggan->tarif->tarifperkwh ?? 0, 0, ',', '.') }}/kWh</p>
                    <p><strong>Tagihan Belum Bayar:</strong> <span class="text-red-600 font-semibold">{{ $tagihans->count() }}</span></p>
                </div>
            </div>
        </x-card>

        <!-- Daftar Tagihan Belum Bayar -->
        <x-card class="p-6 bg-white rounded-lg shadow-md mb-6">
            <h3 class="text-lg font-semibold mb-4 text-orange-600">Tagihan Belum Bayar</h3>
            <div class="overflow-x-auto">
                <table class="w-full table-auto min-w-full border-collapse border border-gray-300 rounded-lg">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-6 py-3 text-left border border-gray-300">Periode</th>
                            <th class="px-6 py-3 text-left border border-gray-300">Jumlah Meter</th>
                            <th class="px-6 py-3 text-left border border-gray-300">Total Tagihan</th>
                            <th class="px-6 py-3 text-left border border-gray-300">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tagihans as $tagihanItem)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 border border-gray-300">
                                    <div class="font-medium">{{ date('F', mktime(0, 0, 0, $tagihanItem->bulan, 1)) }}</div>
                                    <div class="text-sm text-gray-500">{{ $tagihanItem->tahun }}</div>
                                </td>
                                <td class="px-6 py-4 border border-gray-300">{{ number_format($tagihanItem->jumlah_meter, 0, ',', '.') }} kWh</td>
                                <td class="px-6 py-4 border border-gray-300 font-semibold text-blue-600">
                                    Rp {{ number_format($tagihanItem->jumlah_meter * ($tagihanItem->pelanggan->tarif->tarifperkwh ?? 0), 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 border border-gray-300">
                                    <x-button href="{{ route('pembayarans.create', ['tagihan_id' => $tagihanItem->id_tagihan]) }}" variant="success">
                                        <i class="fas fa-credit-card mr-1"></i>Bayar
                                    </x-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>
    @elseif($pelanggan && $tagihans->count() == 0)
        <x-card class="p-6 bg-white rounded-lg shadow-md mb-6">
            <div class="text-center py-8">
                <i class="fas fa-check-circle text-green-500 text-4xl mb-4"></i>
                <h3 class="text-lg font-semibold text-green-600 mb-2">Semua Tagihan Sudah Dibayar</h3>
                <p class="text-gray-600">Pelanggan {{ $pelanggan->nama_pelanggan }} tidak memiliki tagihan yang belum dibayar.</p>
            </div>
        </x-card>
    @elseif(request('id_pelanggan'))
        <x-card class="p-6 bg-white rounded-lg shadow-md mb-6">
            <div class="text-center py-8">
                <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-4"></i>
                <h3 class="text-lg font-semibold text-yellow-600 mb-2">Pelanggan Tidak Ditemukan</h3>
                <p class="text-gray-600">ID Pelanggan "{{ request('id_pelanggan') }}" tidak ditemukan dalam sistem.</p>
            </div>
        </x-card>
    @endif

    @if($tagihan)
        <!-- Form pembayaran untuk tagihan tertentu -->
        <x-card>
            <h3 class="text-lg font-semibold mb-4 text-green-600">Detail Tagihan yang Akan Dibayar</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                <div>
                    <p><strong>Pelanggan:</strong> {{ $tagihan->pelanggan->nama_pelanggan }}</p>
                    <p><strong>Nomor KWH:</strong> {{ $tagihan->pelanggan->nomor_kwh }}</p>
                    <p><strong>Periode:</strong> {{ date('F', mktime(0, 0, 0, $tagihan->bulan, 1)) }} {{ $tagihan->tahun }}</p>
                </div>
                <div>
                    <p><strong>Jumlah Meter:</strong> {{ number_format($tagihan->jumlah_meter, 0, ',', '.') }} kWh</p>
                    <p><strong>Tarif per kWh:</strong> Rp {{ number_format($tagihan->pelanggan->tarif->tarifperkwh ?? 0, 0, ',', '.') }}</p>
                    <p><strong>Total Tagihan:</strong> <span class="font-bold text-blue-600">Rp {{ number_format($tagihan->jumlah_meter * ($tagihan->pelanggan->tarif->tarifperkwh ?? 0), 0, ',', '.') }}</span></p>
                </div>
            </div>

            <form action="{{ route('pembayarans.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_tagihan" value="{{ $tagihan->id_tagihan }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="biaya_admin" class="block text-gray-700 text-sm font-bold mb-2">Biaya Admin</label>
                        <input type="number" step="0.01" id="biaya_admin" name="biaya_admin" value="{{ old('biaya_admin', 2500) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        @error('biaya_admin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="uang_dibayar" class="block text-gray-700 text-sm font-bold mb-2">Uang yang Dibayar</label>
                        <input type="number" step="0.01" id="uang_dibayar" name="uang_dibayar" value="{{ old('uang_dibayar') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        @error('uang_dibayar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kalkulasi otomatis -->
                <div class="bg-gray-50 p-4 rounded mb-4">
                    <h4 class="font-semibold mb-2">Kalkulasi Pembayaran</h4>
                    <div id="kalkulasi">
                        <p>Total Tagihan: Rp <span id="total-tagihan">{{ number_format($tagihan->jumlah_meter * ($tagihan->pelanggan->tarif->tarifperkwh ?? 0), 0, ',', '.') }}</span></p>
                        <p>Biaya Admin: Rp <span id="biaya-admin-display">2.500</span></p>
                        <p><strong>Total Bayar: Rp <span id="total-bayar">0</span></strong></p>
                        <p>Uang Dibayar: Rp <span id="uang-dibayar-display">0</span></p>
                        <p><strong>Kembalian: Rp <span id="kembalian">0</span></strong></p>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <x-button type="submit">Proses Pembayaran</x-button>
                    <x-button href="{{ route('pembayarans.create') }}" variant="secondary">Kembali</x-button>
                </div>
            </form>
        </x-card>
    @endif

    <script>
        // Kalkulasi otomatis
        function updateKalkulasi() {
            @if($tagihan)
                const totalTagihan = {{ $tagihan->jumlah_meter * ($tagihan->pelanggan->tarif->tarifperkwh ?? 0) }};
                const biayaAdmin = parseFloat(document.getElementById('biaya_admin').value) || 0;
                const uangDibayar = parseFloat(document.getElementById('uang_dibayar').value) || 0;

                const totalBayar = totalTagihan + biayaAdmin;
                const kembalian = uangDibayar - totalBayar;

                document.getElementById('biaya-admin-display').textContent = biayaAdmin.toLocaleString('id-ID');
                document.getElementById('total-bayar').textContent = totalBayar.toLocaleString('id-ID');
                document.getElementById('uang-dibayar-display').textContent = uangDibayar.toLocaleString('id-ID');
                document.getElementById('kembalian').textContent = kembalian.toLocaleString('id-ID');
            @endif
        }

        @if($tagihan)
            document.getElementById('biaya_admin').addEventListener('input', updateKalkulasi);
            document.getElementById('uang_dibayar').addEventListener('input', updateKalkulasi);

            // Initial calculation
            updateKalkulasi();
        @endif
    </script>
</x-layouts.dashboard>
