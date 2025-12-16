<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Mahasiswa - Brain</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-beige-50">
    <x-sidebar role="mahasiswa" />

    <div class="ml-64 min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="text-gray-600 mt-1">Akses materi kuliah dan mulai belajar</p>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gradient-to-br from-primary-600 to-primary-700 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm font-medium">Total Materi Tersedia</p>
                            <p class="text-4xl font-bold mt-2">{{ $stats['total_materials'] }}</p>
                            <p class="text-white/70 text-sm mt-2">Dari semua semester</p>
                        </div>
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-beige-500 to-beige-600 rounded-xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm font-medium">Semester Aktif</p>
                            <p class="text-4xl font-bold mt-2">{{ count($stats['semesters']) }}</p>
                            <p class="text-white/70 text-sm mt-2">Pilih semester di sidebar</p>
                        </div>
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Materials -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Materi Terbaru</h2>
                    <a href="{{ route('mahasiswa.materials') }}" class="text-primary-600 hover:text-primary-700 font-medium text-sm">
                        Lihat Semua →
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($recentMaterials as $material)
                    <a href="{{ route('mahasiswa.materials.show', $material) }}"
                       class="group bg-beige-50 hover:bg-beige-100 rounded-xl p-6 transition-all hover:shadow-md">
                        <div class="flex items-start justify-between mb-3">
                            <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-medium">
                                Semester {{ $material->course->semester }}
                            </span>
                            @if($material->file_path)
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            @endif
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-primary-600 transition-colors">
                            {{ $material->title }}
                        </h3>
                        <p class="text-sm text-gray-600 mb-3">{{ $material->course->name }}</p>
                        @if($material->description)
                        <p class="text-sm text-gray-700 line-clamp-2">{{ Str::limit($material->description, 80) }}</p>
                        @endif
                        <div class="mt-4 flex items-center text-xs text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $material->created_at->format('d M Y') }}
                        </div>
                    </a>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-gray-600">Belum ada materi tersedia</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</body>
</html>
