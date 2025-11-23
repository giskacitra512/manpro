<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Materi - BiomediHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-beige-50">
    <x-sidebar role="admin" />

    <div class="ml-64 min-h-screen">
        <header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.materials.index') }}" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Edit Materi</h1>
                    <p class="text-gray-600 mt-1">Update informasi materi kuliah</p>
                </div>
            </div>
        </header>

        <main class="p-8">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-xl shadow-md p-8">
                    <form action="{{ route('admin.materials.update', $material) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Materi *</label>
                            <input type="text" id="title" name="title" required value="{{ old('title', $material->title) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent">
                        </div>

                        <div>
                            <label for="mata_kuliah" class="block text-sm font-medium text-gray-700 mb-2">Mata Kuliah *</label>
                            <input type="text" id="mata_kuliah" name="mata_kuliah" required value="{{ old('mata_kuliah', $material->mata_kuliah) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent">
                        </div>

                        <div>
                            <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">Semester *</label>
                            <select id="semester" name="semester" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent">
                                @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ old('semester', $material->semester) == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Singkat</label>
                            <textarea id="description" name="description" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent">{{ old('description', $material->description) }}</textarea>
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten Materi</label>
                            <textarea id="content" name="content" rows="8"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent">{{ old('content', $material->content) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">File Saat Ini</label>
                            @if($material->file_path)
                            <div class="flex items-center space-x-2 mb-4 p-3 bg-beige-50 rounded-lg">
                                <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-sm text-gray-700">{{ basename($material->file_path) }}</span>
                            </div>
                            @else
                            <p class="text-sm text-gray-500 mb-4">Tidak ada file</p>
                            @endif

                            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Upload File Baru (Opsional)</label>
                            <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX, PPT, PPTX max 10MB</p>
                        </div>

                        <div class="flex gap-4 pt-4">
                            <button type="submit" class="flex-1 btn-primary">
                                Update Materi
                            </button>
                            <a href="{{ route('admin.materials.index') }}" class="flex-1 text-center btn-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
