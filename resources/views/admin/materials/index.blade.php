<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Materi - Brain</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-beige-50">
    <x-sidebar role="admin" />

    <div class="ml-64 min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Kelola Materi</h1>
                    <p class="text-gray-600 mt-1">Manage semua materi kuliah</p>
                </div>
                <a href="{{ route('admin.materials.create') }}" class="btn-primary">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Materi
                </a>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-8">
            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
            @endif

            <!-- Filter -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <form method="GET" class="flex gap-4 flex-wrap">
                    <select name="semester" onchange="loadCourses(this.value)" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600">
                        <option value="">Semua Semester</option>
                        @foreach($semesters as $sem)
                        <option value="{{ $sem }}" {{ request('semester') == $sem ? 'selected' : '' }}>Semester {{ $sem }}</option>
                        @endforeach
                    </select>
                    <select name="course_id" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600">
                        <option value="">Semua Mata Kuliah</option>
                        @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn-primary">Filter</button>
                    <a href="{{ route('admin.materials.index') }}" class="btn-secondary">Reset</a>
                </form>
            </div>

            <!-- Materials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($materials as $material)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-4">
                        <div class="flex justify-between items-start">
                            <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white rounded-full text-sm font-medium">
                                Semester {{ $material->course->semester ?? '-' }}
                            </span>
                            @if($material->file_path)
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            @endif
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $material->title }}</h3>
                        <p class="text-sm text-gray-600 mb-3">{{ $material->course->name ?? 'N/A' }}</p>

                        @if($material->description)
                        <p class="text-sm text-gray-700 mb-4 line-clamp-2">{{ Str::limit($material->description, 100) }}</p>
                        @endif

                        <div class="flex items-center text-xs text-gray-500 mb-4">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $material->created_at->format('d M Y') }}
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('admin.materials.edit', $material) }}" class="flex-1 text-center px-4 py-2 bg-beige-500 hover:bg-beige-600 text-white rounded-lg transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('admin.materials.destroy', $material) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-white rounded-xl shadow-md p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Materi</h3>
                    <p class="text-gray-600 mb-4">Mulai dengan menambahkan materi kuliah pertama</p>
                    <a href="{{ route('admin.materials.create') }}" class="btn-primary inline-block">Tambah Materi</a>
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
