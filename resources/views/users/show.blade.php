<x-layouts.dashboard title="Detail Admin - Admin" guard="web" sidebarActive="users">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Detail Admin</h2>
        <p class="text-gray-600 mt-2">Informasi lengkap akun admin</p>
    </div>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">ID User:</strong>
                <p class="text-gray-900">{{ $user->id_user }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Username:</strong>
                <p class="text-gray-900">{{ $user->username }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Nama Admin:</strong>
                <p class="text-gray-900">{{ $user->nama_admin }}</p>
            </div>
            <div class="mb-4">
                <strong class="block text-gray-700 text-sm font-bold mb-2">Level:</strong>
                <p class="text-gray-900">{{ $user->level->nama_level }}</p>
            </div>
        </div>

        <div class="flex items-center justify-between mt-6">
            <x-button href="{{ route('users.index') }}" class="bg-gray-600 hover:bg-gray-700">Kembali</x-button>
            <x-button href="{{ route('users.edit', $user->id_user) }}">Edit</x-button>
        </div>
    </x-card>
</x-layouts.dashboard>
