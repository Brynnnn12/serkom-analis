<x-layouts.dashboard title="Edit Penggunaan - Admin" guard="web" sidebarActive="penggunaans">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Edit Penggunaan Meteran</h2>
        <p class="text-gray-600 mt-2">Edit data penggunaan meteran pelanggan</p>
    </div>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('penggunaans.update', $penggunaan) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="id_pelanggan" class="block text-gray-700 text-sm font-bold mb-2">Pelanggan</label>
                    <select id="id_pelanggan" name="id_pelanggan" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Pelanggan</option>
                        @foreach($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id_pelanggan }}" {{ old('id_pelanggan', $penggunaan->id_pelanggan) == $pelanggan->id_pelanggan ? 'selected' : '' }}>
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
                            <option value="{{ $i }}" {{ old('bulan', $penggunaan->bulan) == $i ? 'selected' : '' }}>
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
                        @for($i = date('Y') - 1; $i <= date('Y') + 1; $i++)
                            <option value="{{ $i }}" {{ old('tahun', $penggunaan->tahun) == $i ? 'selected' : '' }}>
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
                    <input type="number" step="0.01" id="meter_ahir" name="meter_ahir" value="{{ old('meter_ahir', $penggunaan->meter_ahir) }}" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                    @error('meter_ahir')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-gray-600 mt-1">Meter awal akan dihitung otomatis dari bulan sebelumnya</p>
                </div>
            </div>
            <div class="flex items-center justify-between mt-6">
                <x-button type="submit">Update</x-button>
                <x-button href="{{ route('penggunaans.index') }}" variant="secondary">Batal</x-button>
            </div>
        </form>
    </x-card>
</x-layouts.dashboard>
