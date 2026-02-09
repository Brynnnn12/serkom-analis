<x-layouts.dashboard title="Kelola Admin - Admin" guard="web" sidebarActive="users">
    <div class="p-6 bg-white rounded-lg shadow-md mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Kelola Admin</h2>
        <p class="text-gray-600 mt-2">Kelola akun admin sistem</p>
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

    <x-button href="{{ route('users.create') }}" class="mb-4">Tambah Admin Baru</x-button>

    <x-card class="p-6 bg-white rounded-lg shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full table-auto min-w-full border-collapse border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-6 py-3 text-left whitespace-nowrap border border-gray-300">Nama Admin</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Username</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Level</th>
                        <th class="px-6 py-3 text-left border border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4 border border-gray-300">{{ $user->nama_admin }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $user->username }}</td>
                            <td class="px-6 py-4 border border-gray-300">{{ $user->level->nama_level ?? 'N/A' }}</td>
                            <td class="px-6 py-4 border border-gray-300">
                                <x-button href="{{ route('users.edit', $user) }}" variant="warning" class="mr-2">Edit</x-button>
                                @if($user->getKey() != auth()->guard('web')->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-button type="submit" variant="danger" onclick="return confirm('Yakin hapus admin ini?')">Hapus</x-button>
                                    </form>
                                @else
                                    <span class="text-gray-500 text-sm">(Akun Anda)</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500 border border-gray-300">
                                <i class="fas fa-user-shield text-4xl mb-2"></i>
                                <div>Belum ada data admin.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</x-layouts.dashboard>
