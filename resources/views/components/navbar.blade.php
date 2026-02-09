{{-- Navbar Component --}}
@props(['user' => null, 'guard' => null])

<nav class="bg-cyan-400 p-6 mx-4 my-2 rounded-xl shadow-xl">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <!-- Mobile menu button -->
            <button onclick="toggleMobileMenu()" class="lg:hidden text-white hover:text-gray-200 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <h1 class="text-white text-lg lg:text-xl font-bold">
                PLN Bayar Listrik
                @if($guard === 'web')
                    - Admin
                @elseif($guard === 'pelanggan')
                    - Pelanggan
                @endif
            </h1>
        </div>

        <div class="flex items-center space-x-4">
            @if($user)
                <span class="text-white text-sm lg:text-base hidden sm:block">Halo, {{ $user->nama_admin ?? $user->nama_pelanggan }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-2 lg:py-2 lg:px-4 rounded text-sm lg:text-base">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white hover:underline text-sm lg:text-base">Login</a>
            @endif
        </div>
    </div>
</nav>
