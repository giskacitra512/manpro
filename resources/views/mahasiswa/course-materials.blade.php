<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $course->name }} - Brain</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-beige-50">
    <x-sidebar role="mahasiswa" />

    <div class="ml-64 min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('mahasiswa.dashboard', ['semester' => $course->semester]) }}" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-medium">
                            Semester {{ $course->semester }}
                        </span>
                        <span class="text-gray-400">•</span>
                        <span class="text-gray-600">{{ $course->code }}</span>
                        <span class="text-gray-400">•</span>
                        <span class="text-gray-600">{{ $course->credits }} SKS</span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800 mt-2">{{ $course->name }}</h1>
                    @if($course->description)
                    <p class="text-gray-600 mt-1">{{ $course->description }}</p>
                    @endif
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-8">
            <div class="max-w-7xl mx-auto">
                <!-- Stats -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-2">Materi Pembelajaran</h2>
                            <p class="text-gray-600">Total {{ $materials->total() }} materi tersedia untuk mata kuliah ini</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-12 h-12 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Materials Grid -->
                @if($materials->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($materials as $material)
                    <a href="{{ route('mahasiswa.materials.show', $material) }}"
                       class="group bg-white hover:bg-beige-50 rounded-xl shadow-md hover:shadow-lg p-6 transition-all border-2 border-transparent hover:border-primary-600">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-primary-600 transition-colors line-clamp-2">
                                    {{ $material->title }}
                                </h3>
                            </div>
                            @if($material->file_path)
                            <div class="ml-3">
                                <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if($material->description)
                        <p class="text-sm text-gray-700 mb-4 line-clamp-3">{{ $material->description }}</p>
                        @endif

                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $material->created_at->format('d M Y') }}
                            </div>
                            <svg class="w-5 h-5 text-primary-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($materials->hasPages())
                <div class="bg-white rounded-xl shadow-md p-6">
                    {{ $materials->links() }}
                </div>
                @endif
                @else
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <svg class="w-20 h-20 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">Belum Ada Materi</h3>
                    <p class="text-gray-600 mb-6">Materi untuk mata kuliah ini belum tersedia</p>
                    <a href="{{ route('mahasiswa.dashboard', ['semester' => $course->semester]) }}"
                       class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>
