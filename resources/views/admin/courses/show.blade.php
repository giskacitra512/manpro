@extends('layouts.app')

@section('title', 'Detail Mata Kuliah - Admin')

@section('content')
<!-- Header -->
<header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.courses.index') }}" class="text-gray-600 hover:text-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <div class="flex items-center space-x-3">
                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                    Semester {{ $course->semester }}
                </span>
                <span class="text-gray-400">•</span>
                <span class="text-gray-600">{{ $course->code }}</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mt-2">{{ $course->name }}</h1>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="p-8">
    <div class="max-w-6xl mx-auto">
        <!-- Action Buttons -->
        <div class="flex gap-4 mb-6">
            <a href="{{ route('admin.courses.edit', $course) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Mata Kuliah
            </a>
            @if($course->materials->count() == 0)
            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        onclick="return confirm('Yakin ingin menghapus mata kuliah ini?')"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Mata Kuliah
                </button>
            </form>
            @endif
            <a href="{{ route('admin.materials.create') }}?course_id={{ $course->id }}"
               class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Materi
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Course Info Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Mata Kuliah</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Kode Mata Kuliah</label>
                            <p class="text-gray-900 font-medium mt-1">{{ $course->code }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600">Nama Mata Kuliah</label>
                            <p class="text-gray-900 font-medium mt-1">{{ $course->name }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600">Semester</label>
                            <p class="text-gray-900 font-medium mt-1">Semester {{ $course->semester }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600">SKS</label>
                            <p class="text-gray-900 font-medium mt-1">{{ $course->credits }} SKS</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600">Total Materi</label>
                            <p class="text-gray-900 font-medium mt-1">{{ $course->materials->count() }} Materi</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600">Dibuat</label>
                            <p class="text-gray-900 font-medium mt-1">{{ $course->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    @if($course->description)
                    <div class="mt-6 pt-6 border-t">
                        <label class="text-sm font-medium text-gray-600">Deskripsi</label>
                        <p class="text-gray-700 mt-2">{{ $course->description }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Materials List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Materi Tersedia ({{ $course->materials->count() }})</h2>
                        <a href="{{ route('admin.materials.create') }}?course_id={{ $course->id }}"
                           class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                            + Tambah Materi
                        </a>
                    </div>

                    @if($course->materials->count() > 0)
                    <div class="space-y-4">
                        @foreach($course->materials as $material)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-800 mb-1">{{ $material->title }}</h3>
                                    @if($material->description)
                                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($material->description, 100) }}</p>
                                    @endif
                                    <div class="flex items-center gap-4 text-xs text-gray-500">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            {{ $material->created_at->format('d M Y') }}
                                        </span>
                                        @if($material->file_path)
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                            File attachment
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.materials.show', $material) }}"
                                       class="text-blue-600 hover:text-blue-800 p-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.materials.edit', $material) }}"
                                       class="text-green-600 hover:text-green-800 p-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.materials.destroy', $material) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus materi ini?')"
                                                class="text-red-600 hover:text-red-800 p-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Materi</h3>
                        <p class="text-gray-600 mb-4">Mulai tambahkan materi untuk mata kuliah ini</p>
                        <a href="{{ route('admin.materials.create') }}?course_id={{ $course->id }}"
                           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Materi Pertama
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
