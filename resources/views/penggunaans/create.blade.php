<x-layouts.dashboard title="Input Penggunaan - Admin" guard="web" sidebarActive="penggunaans">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Input Penggunaan Meteran Baru</h2>
        <p class="text-gray-600 mt-2">Catat penggunaan meteran bulanan pelanggan</p>
    </div>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('penggunaans.store') }}" method="POST" id="penggunaanForm">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="id_pelanggan" class="block text-gray-700 text-sm font-bold mb-2">Pelanggan</label>
                    <select id="id_pelanggan" name="id_pelanggan" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Pelanggan</option>
                        @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id_pelanggan }}" {{ old('id_pelanggan') == $pelanggan->id_pelanggan ? 'selected' : '' }}>
                                {{ $pelanggan->nama_pelanggan }} - {{ $pelanggan->nomor_kwh }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pelanggan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="bulan" class="block text-gray-700 text-sm font-bold mb-2">Bulan</label>
                    <select id="bulan" name="bulan" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Bulan</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ old('bulan') == $i ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                            </option>
                        @endfor
                    </select>
                    @error('bulan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="tahun" class="block text-gray-700 text-sm font-bold mb-2">Tahun</label>
                    <select id="tahun" name="tahun" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Tahun</option>
                        @for($i = date('Y'); $i <= date('Y') + 1; $i++)
                            <option value="{{ $i }}" {{ old('tahun', date('Y')) == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                    @error('tahun')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="meter_ahir" class="block text-gray-700 text-sm font-bold mb-2">Meter Akhir</label>
                    <input type="number" step="0.01" id="meter_ahir" name="meter_ahir" value="{{ old('meter_ahir') }}" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                    @error('meter_ahir')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-600 mt-1" id="meterInfo">Meter awal akan diambil otomatis dari bulan sebelumnya</p>
                </div>
            </div>

            <!-- Preview Section -->
            <div id="previewSection" class="mt-6 p-4 bg-gray-50 rounded-lg hidden">
                <h3 class="text-lg font-semibold mb-3">Pratinjau Perhitungan</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="font-medium">Meter Awal:</span>
                        <span id="previewMeterAwal">-</span>
                    </div>
                    <div>
                        <span class="font-medium">Meter Akhir:</span>
                        <span id="previewMeterAkhir">-</span>
                    </div>
                    <div>
                        <span class="font-medium">Jumlah Meter:</span>
                        <span id="previewJumlahMeter">-</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <x-button type="submit">Simpan & Buat Tagihan</x-button>
                <x-button href="{{ route('penggunaans.index') }}" variant="secondary">Batal</x-button>
            </div>
        </form>
    </x-card>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pelangganSelect = document.getElementById('id_pelanggan');
            const bulanSelect = document.getElementById('bulan');
            const tahunSelect = document.getElementById('tahun');
            const meterAkhirInput = document.getElementById('meter_ahir');
            const meterInfo = document.getElementById('meterInfo');
            const previewSection = document.getElementById('previewSection');
            const previewMeterAwal = document.getElementById('previewMeterAwal');
            const previewMeterAkhir = document.getElementById('previewMeterAkhir');
            const previewJumlahMeter = document.getElementById('previewJumlahMeter');

            function updatePreview() {
                const pelangganId = pelangganSelect.value;
                const bulan = bulanSelect.value;
                const tahun = tahunSelect.value;
                const meterAkhir = parseFloat(meterAkhirInput.value);

                if (pelangganId && bulan && tahun) {
                    // Get CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                                    document.querySelector('input[name="_token"]')?.value;

                    // Make AJAX call to get previous meter reading
                    fetch('{{ route("penggunaans.getPreviousMeter") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            id_pelanggan: pelangganId,
                            bulan: bulan,
                            tahun: tahun
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const meterAwal = data.meter_awal;
                        const bulanSebelumnya = data.bulan_sebelumnya;

                        if (meterAwal > 0) {
                            meterInfo.textContent = `Meter awal dari ${bulanSebelumnya}: ${meterAwal}`;
                        } else {
                            meterInfo.textContent = 'Meter awal: 0 (penggunaan pertama)';
                        }

                        if (!isNaN(meterAkhir) && meterAkhir > meterAwal) {
                            const jumlahMeter = meterAkhir - meterAwal;
                            previewMeterAwal.textContent = meterAwal;
                            previewMeterAkhir.textContent = meterAkhir;
                            previewJumlahMeter.textContent = jumlahMeter.toFixed(2);
                            previewSection.classList.remove('hidden');
                        } else if (!isNaN(meterAkhir) && meterAkhir <= meterAwal) {
                            previewSection.classList.add('hidden');
                            if (meterAkhir <= meterAwal) {
                                meterInfo.textContent += ' - Meter akhir harus lebih besar dari meter awal!';
                                meterInfo.style.color = 'red';
                            }
                        } else {
                            previewSection.classList.add('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        meterInfo.textContent = 'Error memuat data meter awal';
                        previewSection.classList.add('hidden');
                    });
                } else {
                    meterInfo.textContent = 'Meter awal akan diambil otomatis dari bulan sebelumnya';
                    meterInfo.style.color = '';
                    previewSection.classList.add('hidden');
                }
            }

            pelangganSelect.addEventListener('change', updatePreview);
            bulanSelect.addEventListener('change', updatePreview);
            tahunSelect.addEventListener('change', updatePreview);
            meterAkhirInput.addEventListener('input', updatePreview);
        });
    </script>
</x-layouts.dashboard>
