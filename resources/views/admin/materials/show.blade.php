@extends('layouts.app')

@section('title', 'Detail Materi - Admin')

@section('content')
<!-- Header -->
<header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.materials.index') }}" class="text-gray-600 hover:text-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <div class="flex items-center space-x-3">
                <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-medium">
                    Semester {{ $material->course->semester }}
                </span>
                <span class="text-gray-400">•</span>
                <span class="text-gray-600">{{ $material->course->name }}</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mt-2">{{ $material->title }}</h1>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Action Buttons -->
        <div class="flex gap-4 mb-6">
            <a href="{{ route('admin.materials.edit', $material) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Materi
            </a>
            <form action="{{ route('admin.materials.destroy', $material) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        onclick="return confirm('Yakin ingin menghapus materi ini?')"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Materi
                </button>
            </form>
        </div>

        <!-- Material Info Card -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="border-b pb-4 mb-4">
                <h2 class="text-xl font-bold text-gray-800 mb-2">Informasi Materi</h2>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Semester:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $material->course->semester }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Mata Kuliah:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $material->course->name }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Kode:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $material->course->code }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">SKS:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $material->course->credits }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Diupload:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $material->created_at->format('d M Y') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600">Oleh:</span>
                        <span class="font-medium text-gray-900 ml-2">{{ $material->user->name }}</span>
                    </div>
                </div>
            </div>

            @if($material->description)
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi</h3>
                <p class="text-gray-700">{{ $material->description }}</p>
            </div>
            @endif

            @if($material->content)
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Konten Materi</h3>
                <div class="prose max-w-none text-gray-700 whitespace-pre-wrap">{{ $material->content }}</div>
            </div>
            @endif

            @if($material->file_path)
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">File Attachment</h3>
                <a href="{{ Storage::url($material->file_path) }}"
                   target="_blank"
                   class="inline-flex items-center space-x-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Download File</span>
                </a>
            </div>
            @endif
        </div>

        <!-- Course Description -->
        @if($material->course->description)
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Tentang Mata Kuliah</h3>
            <p class="text-gray-700">{{ $material->course->description }}</p>
        </div>
        @endif

        <!-- Discussions Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800">Diskusi ({{ $material->discussions->count() }})</h3>
            </div>

            <div class="space-y-6">
                @forelse($material->discussions as $discussion)
                <div class="border-b border-gray-100 last:border-0 pb-6 last:pb-0">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-semibold">{{ substr($discussion->user->name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-semibold text-gray-900">{{ $discussion->user->name }}</h4>
                                <span class="text-sm text-gray-500">{{ $discussion->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700 mb-3">{{ $discussion->comment }}</p>

                            <!-- Admin Actions for Discussion -->
                            <div class="flex items-center gap-4 mb-3">
                                <form action="{{ route('admin.discussions.destroy', $discussion) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus komentar ini?')" class="text-xs text-red-600 hover:text-red-800 font-medium">
                                        Hapus Komentar
                                    </button>
                                </form>
                            </div>

                            <!-- Replies -->
                            @if($discussion->replies->count() > 0)
                            <div class="ml-4 pl-4 border-l-2 border-gray-100 space-y-4 mt-4">
                                @foreach($discussion->replies as $reply)
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <h5 class="font-medium text-gray-900 text-sm">{{ $reply->user->name }}</h5>
                                        <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">{{ $reply->comment }}</p>
                                    
                                    <!-- Admin Actions for Reply -->
                                    <form action="{{ route('admin.discussions.destroy', $reply) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus balasan ini?')" class="text-xs text-red-600 hover:text-red-800 font-medium">
                                            Hapus Balasan
                                        </button>
                                    </form>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                    Belum ada diskusi pada materi ini.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</main>
@endsection
