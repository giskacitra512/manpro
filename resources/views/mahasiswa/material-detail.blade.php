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
                    
                    @php
                        $fileExtension = pathinfo($material->file_path, PATHINFO_EXTENSION);
                        $isPdf = strtolower($fileExtension) === 'pdf';
                    @endphp
                    
                    @if($isPdf)
                    <!-- PDF Preview -->
                    <div class="mb-4">
                        <div class="bg-gray-100 rounded-lg overflow-hidden" style="height: 600px;">
                            <iframe src="{{ Storage::url($material->file_path) }}" 
                                    class="w-full h-full border-0"
                                    title="PDF Preview">
                            </iframe>
                        </div>
                    </div>
                    @endif
                    
                    <div class="flex items-center space-x-4 p-4 bg-beige-50 rounded-lg">
                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">{{ basename($material->file_path) }}</p>
                            <p class="text-sm text-gray-600">{{ $isPdf ? 'PDF Document' : 'File Document' }} - Klik download untuk menyimpan</p>
                        </div>
                        <a href="{{ Storage::url($material->file_path) }}" download
                           class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                            Download
                        </a>
                    </div>
                </div>
                @endif

                <!-- Forum Diskusi Section -->
                <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Forum Diskusi
                    </h3>

                    @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                    @endif

                    <!-- Comment Form -->
                    <form action="{{ route('mahasiswa.discussions.store', $material) }}" method="POST" class="mb-8">
                        @csrf
                        <div class="flex items-start space-x-4">
                            <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-primary-600 font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <div class="flex-1">
                                <textarea name="comment" rows="3" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent resize-none"
                                    placeholder="Tulis pertanyaan atau komentar Anda..."></textarea>
                                @error('comment')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <div class="mt-2 flex justify-end">
                                    <button type="submit" class="btn-primary">
                                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                        </svg>
                                        Kirim Komentar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Comments List -->
                    <div class="space-y-6">
                        @forelse($material->discussions as $discussion)
                        <div class="border-l-2 border-gray-200 pl-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-beige-200 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-beige-700 font-bold">{{ substr($discussion->user->name, 0, 1) }}</span>
                                </div>
                                <div class="flex-1">
                                    <div class="bg-beige-50 rounded-lg p-4">
                                        <div class="flex items-center justify-between mb-2">
                                            <div>
                                                <span class="font-semibold text-gray-800">{{ $discussion->user->name }}</span>
                                                <span class="text-sm text-gray-500 ml-2">{{ $discussion->created_at->diffForHumans() }}</span>
                                            </div>
                                            @if($discussion->user_id === Auth::id())
                                            <form action="{{ route('mahasiswa.discussions.destroy', $discussion) }}" method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                        <p class="text-gray-700">{{ $discussion->comment }}</p>
                                    </div>

                                    <!-- Reply Button -->
                                    <button onclick="toggleReplyForm({{ $discussion->id }})" 
                                            class="text-primary-600 hover:text-primary-700 text-sm font-medium mt-2">
                                        💬 Balas
                                    </button>

                                    <!-- Reply Form -->
                                    <form id="reply-form-{{ $discussion->id }}" 
                                          action="{{ route('mahasiswa.discussions.store', $material) }}" 
                                          method="POST" 
                                          class="mt-4 hidden">
                                        @csrf
                                        <input type="hidden" name="parent_id" value="{{ $discussion->id }}">
                                        <div class="flex items-start space-x-4">
                                            <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                                                <span class="text-primary-600 text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                            </div>
                                            <div class="flex-1">
                                                <textarea name="comment" rows="2" required
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-600 text-sm"
                                                    placeholder="Tulis balasan..."></textarea>
                                                <div class="mt-2 flex gap-2">
                                                    <button type="submit" class="px-4 py-1 bg-primary-600 hover:bg-primary-700 text-white rounded text-sm">
                                                        Kirim
                                                    </button>
                                                    <button type="button" onclick="toggleReplyForm({{ $discussion->id }})" 
                                                            class="px-4 py-1 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded text-sm">
                                                        Batal
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- Replies -->
                                    @if($discussion->replies->count() > 0)
                                    <div class="mt-4 space-y-4 ml-8">
                                        @foreach($discussion->replies as $reply)
                                        <div class="flex items-start space-x-3">
                                            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                                                <span class="text-gray-700 text-sm font-bold">{{ substr($reply->user->name, 0, 1) }}</span>
                                            </div>
                                            <div class="flex-1">
                                                <div class="bg-gray-50 rounded-lg p-3">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <div>
                                                            <span class="font-semibold text-gray-800 text-sm">{{ $reply->user->name }}</span>
                                                            <span class="text-xs text-gray-500 ml-2">{{ $reply->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        @if($reply->user_id === Auth::id())
                                                        <form action="{{ route('mahasiswa.discussions.destroy', $reply) }}" method="POST" 
                                                              onsubmit="return confirm('Yakin ingin menghapus balasan ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                    <p class="text-gray-700 text-sm">{{ $reply->comment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <p class="text-gray-600">Belum ada diskusi. Jadilah yang pertama berkomentar!</p>
                        </div>
                        @endforelse
                    </div>
                </div>

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
        </div>
    </div>

    <script>
        function toggleReplyForm(discussionId) {
            const form = document.getElementById('reply-form-' + discussionId);
            if (form.classList.contains('hidden')) {
                form.classList.remove('hidden');
                form.querySelector('textarea').focus();
            } else {
                form.classList.add('hidden');
                form.reset();
            }
        }
    </script>
</body>
</html>
