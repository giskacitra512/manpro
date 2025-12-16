<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mata Kuliah - Brain</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-beige-50">
    <x-sidebar role="mahasiswa" />

    <div class="ml-64 min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Mata Kuliah</h1>
                <p class="text-gray-600 mt-1">Jelajahi mata kuliah berdasarkan semester</p>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-8">
            <!-- Filter -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <form method="GET" class="flex gap-4 flex-wrap items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Filter Semester</label>
                        <select name="semester" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600">
                            <option value="">Semua Semester</option>
                            @foreach($semesters as $sem)
                            <option value="{{ $sem }}" {{ $semester == $sem ? 'selected' : '' }}>Semester {{ $sem }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($semester)
                    <div>
                        <a href="{{ route('mahasiswa.materials') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition-colors">
                            Reset Filter
                        </a>
                    </div>
                    @endif
                </form>
            </div>

            <!-- Stats -->
            @if($semester)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Mata Kuliah</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $courses->total() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Total SKS</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $courses->sum('credits') }}</p>
                        </div>
                        <div class="w-12 h-12 bg-beige-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-beige-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Total Materi</p>
                            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $courses->sum('materials_count') }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Courses Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courses as $course)
                <a href="{{ route('mahasiswa.courses.materials', $course) }}"
                   class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all transform hover:-translate-y-1">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-4">
                        <div class="flex justify-between items-start">
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white rounded-full text-sm font-medium">
                                Semester {{ $course->semester }}
                            </span>
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white rounded-full text-sm font-medium">
                                {{ $course->credits }} SKS
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="text-xs font-medium text-gray-500 mb-2">{{ $course->code }}</div>
                        <h3 class="text-lg font-bold text-gray-800 mb-3 group-hover:text-primary-600 transition-colors min-h-[3.5rem] line-clamp-2">
                            {{ $course->name }}
                        </h3>

                        @if($course->description)
                        <p class="text-sm text-gray-700 mb-4 line-clamp-2">
                            {{ $course->description }}
                        </p>
                        @endif

                        <div class="flex items-center justify-between text-sm pt-4 border-t border-gray-200">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                {{ $course->materials_count }} Materi
                            </div>
                            <svg class="w-5 h-5 text-primary-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full bg-white rounded-xl shadow-md p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Mata Kuliah</h3>
                    <p class="text-gray-600 mb-4">
                        @if($semester)
                        Tidak ada mata kuliah untuk semester {{ $semester }}
                        @else
                        Belum ada mata kuliah tersedia
                        @endif
                    </p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($courses->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $courses->links() }}
            </div>
            @endif
        </main>
    </div>
</body>
</html>
