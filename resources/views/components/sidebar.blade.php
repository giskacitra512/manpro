@props(['role' => 'mahasiswa'])

<aside class="w-64 bg-white shadow-lg h-screen fixed left-0 top-0 overflow-y-auto">
    <!-- Logo & Brand -->
    <div class="p-6 border-b border-gray-200">
        <a href="{{ url('/') }}" class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full overflow-hidden bg-white flex items-center justify-center flex-shrink-0">
                <img src="{{ asset('asset/images/logo.PNG') }}" alt="BiomediHub Logo" class="w-full h-full object-cover">
            </div>
            <div>
                <span class="font-bold text-xl text-gray-800">Brain</span>
                <p class="text-xs text-gray-500">{{ ucfirst($role) }} Portal</p>
            </div>
        </a>
    </div>

    <!-- User Info -->
    <div class="p-6 border-b border-gray-200 bg-beige-50">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                <span class="text-primary-600 font-bold text-lg">{{ substr(Auth::user()->name, 0, 1) }}</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                <p class="text-sm text-gray-600 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="p-4 space-y-2">
        @if($role === 'admin')
            <!-- Admin Navigation -->
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary-600 text-white' : 'text-gray-700 hover:bg-beige-100' }} transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <a href="{{ route('admin.materials.index') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.materials.*') ? 'bg-primary-600 text-white' : 'text-gray-700 hover:bg-beige-100' }} transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span class="font-medium">Kelola Materi</span>
            </a>

            <a href="{{ route('admin.courses.index') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.courses.*') ? 'bg-primary-600 text-white' : 'text-gray-700 hover:bg-beige-100' }} transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span class="font-medium">Kelola Mata Kuliah</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-primary-600 text-white' : 'text-gray-700 hover:bg-beige-100' }} transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span class="font-medium">Kelola User</span>
            </a>

            <a href="{{ route('admin.discussions.index') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.discussions.*') ? 'bg-primary-600 text-white' : 'text-gray-700 hover:bg-beige-100' }} transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span class="font-medium">Kelola Diskusi</span>
            </a>
        @else
            <!-- Mahasiswa Navigation -->
            <a href="{{ route('mahasiswa.dashboard') }}"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-primary-600 text-white' : 'text-gray-700 hover:bg-beige-100' }} transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <div class="px-4 pt-4 pb-2">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Mata Kuliah per Semester</p>
            </div>

            @for($i = 1; $i <= 8; $i++)
            <a href="{{ route('mahasiswa.dashboard', ['semester' => $i]) }}"
               class="flex items-center justify-between px-4 py-3 rounded-lg {{ request()->get('semester') == $i && request()->routeIs('mahasiswa.dashboard') ? 'bg-primary-600 text-white' : 'text-gray-700 hover:bg-beige-100' }} transition-colors">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span class="font-medium">Semester {{ $i }}</span>
                </div>
            </a>
            @endfor

            <a href="#"
               class="flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-beige-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span class="font-medium">Forum Diskusi</span>
            </a>
        @endif
    </nav>

    <!-- Logout Button -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200 bg-white">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span class="font-medium">Logout</span>
            </button>
        </form>
    </div>
</aside>
