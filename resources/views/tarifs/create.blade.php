<x-layouts.dashboard title="Tambah Tarif - Admin" guard="web" sidebarActive="tarifs">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Tambah Tarif Baru</h2>
        <p class="text-gray-600 mt-2">Tambahkan tarif listrik baru berdasarkan daya</p>
    </div>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('tarifs.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="daya" class="block text-gray-700 text-sm font-bold mb-2">Daya</label>
                <input type="text" id="daya" name="daya" value="{{ old('daya') }}" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                @error('daya')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="tarifperkwh" class="block text-gray-700 text-sm font-bold mb-2">Tarif per kWh</label>
                <input type="number" step="0.01" id="tarifperkwh" name="tarifperkwh" value="{{ old('tarifperkwh') }}" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                @error('tarifperkwh')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between mt-6">
                <x-button type="submit">Simpan</x-button>
                <x-button href="{{ route('tarifs.index') }}" class="bg-gray-600 hover:bg-gray-700">Batal</x-button>
            </div>
        </form>
    </x-card>
</x-layouts.dashboard>
