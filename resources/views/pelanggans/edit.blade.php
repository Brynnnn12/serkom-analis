<x-layouts.dashboard title="Edit Pelanggan - Admin" guard="web" sidebarActive="pelanggans">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Edit Pelanggan</h2>
        <p class="text-gray-600 mt-2">Edit data pelanggan PLN</p>
    </div>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('pelanggans.update', $pelanggan) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="nama_pelanggan" class="block text-gray-700 text-sm font-bold mb-2">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                    @error('nama_pelanggan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="nomor_kwh" class="block text-gray-700 text-sm font-bold mb-2">Nomor KWH</label>
                    <input type="text" id="nomor_kwh" name="nomor_kwh" value="{{ old('nomor_kwh', $pelanggan->nomor_kwh) }}" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                    @error('nomor_kwh')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4 md:col-span-2">
                    <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="id_tarif" class="block text-gray-700 text-sm font-bold mb-2">Tarif</label>
                    <select id="id_tarif" name="id_tarif" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Tarif</option>
                        @foreach($tarifs as $tarif)
                            <option value="{{ $tarif->id_tarif }}" {{ old('id_tarif', $pelanggan->id_tarif) == $tarif->id_tarif ? 'selected' : '' }}>
                                {{ $tarif->daya }} - Rp {{ number_format($tarif->tarifperkwh, 0, ',', '.') }}/kWh
                            </option>
                        @endforeach
                    </select>
                    @error('id_tarif')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username', $pelanggan->username) }}" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" id="password" name="password" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex items-center justify-between mt-6">
                <x-button type="submit">Update</x-button>
                <x-button href="{{ route('pelanggans.index') }}" variant="secondary">Batal</x-button>
            </div>
        </form>
    </x-card>
</x-layouts.dashboard>
