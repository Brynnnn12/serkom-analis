{{-- Navbar Component --}}
@props(['user' => null, 'guard' => null])

<nav class="bg-blue-600 p-8 mx-6 my-4 rounded-3xl shadow-2xl">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <!-- Mobile menu button -->
            <button onclick="toggleMobileMenu()" class="lg:hidden text-white hover:text-blue-100 focus:outline-none p-2">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <h1 class="text-white text-xl lg:text-2xl font-bold">
                <i class="fas fa-bolt text-yellow-300 mr-3"></i>
                PLN Bayar Listrik
                @if($guard === 'web')
                    - Admin
                @elseif($guard === 'pelanggan')
                    - Pelanggan
                @endif
            </h1>
        </div>

        <div class="flex items-center space-x-6">
            @if($user)
                <span class="text-white text-sm lg:text-base hidden sm:block font-medium">Halo, {{ $user->nama_admin ?? $user->nama_pelanggan }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 lg:py-3 lg:px-6 rounded-lg text-sm lg:text-base transition duration-200 shadow-md">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white hover:text-blue-100 hover:underline text-sm lg:text-base transition duration-200 font-medium py-2 px-4 rounded-lg hover:bg-blue-700">Login</a>
            @endif
        </div>
    </div>
</nav>
