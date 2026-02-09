<x-layouts.dashboard title="Tambah Admin - Admin" guard="web" sidebarActive="users">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Tambah Admin Baru</h2>
        <p class="text-gray-600 mt-2">Tambahkan akun admin baru dengan level Administrator</p>
    </div>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="nama_admin" class="block text-gray-700 text-sm font-bold mb-2">Nama Admin</label>
                    <input type="text" id="nama_admin" name="nama_admin" value="{{ old('nama_admin') }}" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                    @error('nama_admin')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="id_level" class="block text-gray-700 text-sm font-bold mb-2">Level</label>
                    <input type="hidden" name="id_level" value="{{ $levels->where('nama_level', 'Administrator')->first()->id_level ?? 1 }}">
                    <input type="text" value="Administrator" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight bg-gray-100" readonly>
                    <p class="text-sm text-gray-500 mt-1">Admin baru otomatis mendapat level Administrator</p>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex items-center justify-between mt-6">
                <x-button type="submit">Simpan</x-button>
                <x-button href="{{ route('users.index') }}" variant="secondary">Batal</x-button>
            </div>
        </form>
    </x-card>
</x-layouts.dashboard>
