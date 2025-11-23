<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $material->title }} - BiomediHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-beige-50">
    <x-sidebar role="mahasiswa" />

    <div class="ml-64 min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('mahasiswa.materials', ['semester' => $material->semester]) }}" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-medium">
                            Semester {{ $material->semester }}
                        </span>
                        <span class="text-gray-400">•</span>
                        <span class="text-gray-600">{{ $material->mata_kuliah }}</span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-800 mt-2">{{ $material->title }}</h1>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-8">
            <div class="max-w-4xl mx-auto">
                <!-- Material Info Card -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Diupload: {{ $material->created_at->format('d F Y') }}
                        </div>
                        @if($material->file_path)
                        <a href="{{ Storage::url($material->file_path) }}" target="_blank"
                           class="flex items-center space-x-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Download File</span>
                        </a>
                        @endif
                    </div>

                    @if($material->description)
                    <div class="border-t border-gray-200 pt-4">
                        <h3 class="font-semibold text-gray-800 mb-2">Deskripsi</h3>
                        <p class="text-gray-700">{{ $material->description }}</p>
                    </div>
                    @endif
                </div>

                <!-- Material Content -->
                @if($material->content)
                <div class="bg-white rounded-xl shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Konten Materi</h2>
                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $material->content }}</div>
                    </div>
                </div>
                @endif

                <!-- File Preview Section -->
                @if($material->file_path)
                <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">File Lampiran</h3>
                    <div class="flex items-center space-x-4 p-4 bg-beige-50 rounded-lg">
                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">{{ basename($material->file_path) }}</p>
                            <p class="text-sm text-gray-600">Klik tombol download untuk mengunduh file</p>
                        </div>
                        <a href="{{ Storage::url($material->file_path) }}" download
                           class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                            Download
                        </a>
                    </div>
                </div>
                @endif

                <!-- Navigation -->
                <div class="mt-8 flex justify-between">
                    <a href="{{ route('mahasiswa.materials', ['semester' => $material->semester]) }}"
                       class="flex items-center space-x-2 text-gray-600 hover:text-primary-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span>Kembali ke Daftar Materi</span>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
