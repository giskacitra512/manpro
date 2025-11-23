<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Materi Semester {{ $semester }} - BiomediHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-beige-50">
    <x-sidebar role="mahasiswa" />

    <div class="ml-64 min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Materi Semester {{ $semester }}</h1>
                <p class="text-gray-600 mt-1">Jelajahi materi kuliah untuk semester ini</p>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-8">
            <!-- Materials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($materials as $material)
                <a href="{{ route('mahasiswa.materials.show', $material) }}"
                   class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all transform hover:-translate-y-1">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-4">
                        <div class="flex justify-between items-start">
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white rounded-full text-sm font-medium">
                                {{ $material->mata_kuliah }}
                            </span>
                            @if($material->file_path)
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-3 group-hover:text-primary-600 transition-colors">
                            {{ $material->title }}
                        </h3>

                        @if($material->description)
                        <p class="text-sm text-gray-700 mb-4 line-clamp-3">
                            {{ $material->description }}
                        </p>
                        @endif

                        <div class="flex items-center justify-between text-xs text-gray-500 pt-4 border-t border-gray-200">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $material->created_at->format('d M Y') }}
                            </div>
                            <span class="text-primary-600 group-hover:text-primary-700 font-medium">
                                Baca →
                            </span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full bg-white rounded-xl shadow-md p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Materi</h3>
                    <p class="text-gray-600">Materi untuk semester {{ $semester }} belum tersedia</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($materials->hasPages())
            <div class="mt-8">
                {{ $materials->links() }}
            </div>
            @endif
        </main>
    </div>
</body>
</html>
