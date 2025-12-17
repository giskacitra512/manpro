@extends('layouts.app')

@section('title', 'Edit Mata Kuliah - Admin')

@section('content')
<!-- Header -->
<header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit Mata Kuliah</h1>
            <p class="text-gray-600 mt-1">Perbarui informasi mata kuliah</p>
        </div>
        <a href="{{ route('admin.courses.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>
    </div>
</header>

<!-- Main Content -->
<main class="p-8">
    <!-- Error Messages -->
    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <p class="font-semibold">Terdapat kesalahan:</p>
        <ul class="list-disc list-inside mt-2">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-md p-8 max-w-3xl">
        <form method="POST" action="{{ route('admin.courses.update', $course) }}">
            @csrf
            @method('PUT')

            <!-- Course Code -->
            <div class="mb-6">
                <label for="code" class="block text-gray-700 font-semibold mb-2">
                    Kode Mata Kuliah <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       id="code"
                       name="code"
                       value="{{ old('code', $course->code) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('code') border-red-500 @enderror"
                       placeholder="Contoh: CS101"
                       required>
                @error('code')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Course Name -->
            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-semibold mb-2">
                    Nama Mata Kuliah <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $course->name) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                       placeholder="Contoh: Pemrograman Web"
                       required>
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Semester -->
            <div class="mb-6">
                <label for="semester" class="block text-gray-700 font-semibold mb-2">
                    Semester <span class="text-red-500">*</span>
                </label>
                <select id="semester"
                        name="semester"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('semester') border-red-500 @enderror"
                        required>
                    <option value="">Pilih Semester</option>
                    @for($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}" {{ old('semester', $course->semester) == $i ? 'selected' : '' }}>
                        Semester {{ $i }}
                    </option>
                    @endfor
                </select>
                @error('semester')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Credits -->
            <div class="mb-6">
                <label for="credits" class="block text-gray-700 font-semibold mb-2">
                    SKS (Satuan Kredit Semester) <span class="text-red-500">*</span>
                </label>
                <select id="credits"
                        name="credits"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('credits') border-red-500 @enderror"
                        required>
                    <option value="">Pilih SKS</option>
                    @for($i = 1; $i <= 6; $i++)
                    <option value="{{ $i }}" {{ old('credits', $course->credits) == $i ? 'selected' : '' }}>
                        {{ $i }} SKS
                    </option>
                    @endfor
                </select>
                @error('credits')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-semibold mb-2">
                    Deskripsi
                </label>
                <textarea id="description"
                          name="description"
                          rows="5"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                          placeholder="Masukkan deskripsi mata kuliah (opsional)">{{ old('description', $course->description) }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4 justify-end">
                <a href="{{ route('admin.courses.index') }}"
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                    Batal
                </a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
                    Update Mata Kuliah
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
