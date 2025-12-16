<nav class="bg-white shadow-lg fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center space-x-3">
                    <div class="w-12 h-12 rounded-full overflow-hidden bg-white shadow-md flex items-center justify-center flex-shrink-0">
                        <img src="{{ asset('asset/images/logo.PNG') }}" alt="Brain Logo" class="w-full h-full object-cover">
                    </div>
                    <span class="font-bold text-xl text-gray-800">Brain</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">Home</a>
                <a href="#about" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">About</a>
                <a href="#contact" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">Contact</a>

                @auth
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="btn-primary">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="btn-primary">Register</a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-700 hover:text-primary-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="#home" class="block px-3 py-2 text-gray-700 hover:bg-beige-100 hover:text-primary-600 rounded-md">Home</a>
            <a href="#about" class="block px-3 py-2 text-gray-700 hover:bg-beige-100 hover:text-primary-600 rounded-md">About</a>
            <a href="#contact" class="block px-3 py-2 text-gray-700 hover:bg-beige-100 hover:text-primary-600 rounded-md">Contact</a>

            @auth
                <div class="px-3 py-2 text-gray-700">{{ Auth::user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-gray-700 hover:bg-beige-100 hover:text-primary-600 rounded-md">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-700 hover:bg-beige-100 hover:text-primary-600 rounded-md">Login</a>
                <a href="{{ route('register') }}" class="block px-3 py-2 text-gray-700 hover:bg-beige-100 hover:text-primary-600 rounded-md">Register</a>
            @endauth
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>
