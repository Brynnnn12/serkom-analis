<x-layouts.dashboard title="Detail Tagihan - {{ auth()->guard('web')->check() ? 'Admin' : 'Pelanggan' }}" guard="{{ auth()->guard('web')->check() ? 'web' : 'pelanggan' }}" sidebarActive="tagihans">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Detail Tagihan</h2>
        <p class="text-gray-600 mt-2">Informasi lengkap tagihan listrik</p>
    </div>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Informasi Tagihan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">ID Tagihan:</span>
                        <span>{{ $tagihan->id_tagihan }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Pelanggan:</span>
                        <span>{{ $tagihan->pelanggan->nama_pelanggan }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Nomor KWH:</span>
                        <span>{{ $tagihan->pelanggan->nomor_kwh }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Alamat:</span>
                        <span>{{ $tagihan->pelanggan->alamat }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Periode:</span>
                        <span>{{ date('F', mktime(0, 0, 0, $tagihan->bulan, 1)) }} {{ $tagihan->tahun }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium">Status:</span>
                        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $tagihan->status == 'Belum Bayar' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                            {{ $tagihan->status }}
                        </span>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4 text-blue-600">Detail Penggunaan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="font-medium">Meter Awal:</span>
                        <span>{{ number_format($tagihan->penggunaan->meter_awal ?? 0, 0, ',', '.') }} kWh</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Meter Akhir:</span>
                        <span>{{ number_format($tagihan->penggunaan->meter_ahir ?? 0, 0, ',', '.') }} kWh</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Jumlah Pemakaian:</span>
                        <span class="font-semibold">{{ number_format($tagihan->jumlah_meter, 0, ',', '.') }} kWh</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Tarif per kWh:</span>
                        <span>Rp {{ number_format($tagihan->pelanggan->tarif->tarifperkwh ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between text-lg font-bold">
                        <span>Total Tagihan:</span>
                        <span class="text-blue-600">Rp {{ number_format($tagihan->jumlah_meter * ($tagihan->pelanggan->tarif->tarifperkwh ?? 0), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        @if($tagihan->pembayaran)
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-4 text-green-600">Riwayat Pembayaran</h3>
                <div class="bg-green-50 border border-green-200 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="flex justify-between">
                            <span class="font-medium">Tanggal Bayar:</span>
                            <span>{{ \Carbon\Carbon::parse($tagihan->pembayaran->tanggal_pembayaran)->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Biaya Admin:</span>
                            <span>Rp {{ number_format($tagihan->pembayaran->biaya_admin ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Total Bayar:</span>
                            <span class="font-semibold">Rp {{ number_format($tagihan->pembayaran->total_bayar ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-6 flex justify-between">
            <x-button href="{{ route('tagihans.index') }}" variant="secondary">Kembali ke Daftar Tagihan</x-button>
            @if(auth()->guard('web')->check() && $tagihan->status == 'Belum Bayar')
                <x-button href="{{ route('pembayarans.create', ['tagihan_id' => $tagihan->id_tagihan]) }}" variant="success">Proses Pembayaran</x-button>
            @endif
        </div>
    </x-card>
</x-layouts.dashboard>
