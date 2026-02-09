<x-layouts.dashboard title="Edit Admin - Admin" guard="web" sidebarActive="users">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Edit Admin</h2>
        <p class="text-gray-600 mt-2">Edit akun admin sistem</p>
    </div>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="nama_admin" class="block text-gray-700 text-sm font-bold mb-2">Nama Admin</label>
                    <input type="text" id="nama_admin" name="nama_admin" value="{{ old('nama_admin', $user->nama_admin) }}" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                    @error('nama_admin')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="id_level" class="block text-gray-700 text-sm font-bold mb-2">Level</label>
                    <select id="id_level" name="id_level" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Level</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id_level }}" {{ old('id_level', $user->id_level) == $level->id_level ? 'selected' : '' }}>
                                {{ $level->nama_level }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_level')
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
                <x-button href="{{ route('users.index') }}" class="bg-gray-600 hover:bg-gray-700">Batal</x-button>
            </div>
        </form>
    </x-card>
</x-layouts.dashboard>
