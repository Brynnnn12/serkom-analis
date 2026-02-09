<x-layouts.app title="Login - PLN Bayar Listrik">
    <div class="min-h-screen flex items-center justify-center bg-linear-to-br from-blue-600 to-blue-800">
        <div class="max-w-md w-full bg-white rounded-xl shadow-2xl p-8 mx-4">
            <div class="text-center mb-8">
                <div class="bg-blue-600 rounded-full w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                    <i class="fas fa-bolt text-white text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-blue-600 mb-2">PLN</h1>
                <h2 class="text-lg text-gray-600">Bayar Listrik</h2>
                <p class="text-sm text-gray-500 mt-2">Masuk ke akun Anda</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 rounded-lg p-4 mb-6">
                    <ul class="text-red-700 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="username" class="block text-gray-700 text-sm font-semibold mb-2">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" placeholder="Masukkan username" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" placeholder="Masukkan password" required>
                </div>
                <div class="flex items-center justify-between">
                    <x-button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200">Masuk</x-button>
                </div>
            </form>

            <div class="text-center mt-6">
                <p class="text-sm text-gray-500">© 2026 PLN Bayar Listrik. All rights reserved.</p>
            </div>
        </div>
    </div>
</x-layouts.app>
