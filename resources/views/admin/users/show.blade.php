@extends('layouts.app')

@section('title', 'Detail User - Admin')

@section('content')
<!-- Header -->
<header class="bg-white shadow-sm border-b border-gray-200 px-8 py-6">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-gray-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Detail User</h1>
            <p class="text-gray-600 mt-1">Informasi lengkap user</p>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Action Buttons -->
        <div class="flex gap-4 mb-6">
            <a href="{{ route('admin.users.edit', $user) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit User
            </a>
            @if($user->id !== auth()->id())
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        onclick="return confirm('Yakin ingin menghapus user ini?')"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus User
                </button>
            </form>
            @endif
        </div>

        <!-- User Info Card -->
        <div class="bg-white rounded-xl shadow-md p-8">
            <div class="flex items-start space-x-6 mb-6 pb-6 border-b">
                <div class="w-24 h-24 bg-primary-100 rounded-full flex items-center justify-center">
                    <span class="text-primary-600 font-bold text-4xl">{{ substr($user->name, 0, 1) }}</span>
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $user->name }}</h2>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{ $user->role->name === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                        {{ ucfirst($user->role->name) }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-medium text-gray-600">Email</label>
                    <p class="text-gray-900 font-medium mt-1">{{ $user->email }}</p>
                </div>

                @if($user->nim)
                <div>
                    <label class="text-sm font-medium text-gray-600">NIM</label>
                    <p class="text-gray-900 font-medium mt-1">{{ $user->nim }}</p>
                </div>
                @endif

                <div>
                    <label class="text-sm font-medium text-gray-600">Role</label>
                    <p class="text-gray-900 font-medium mt-1">{{ ucfirst($user->role->name) }}</p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">Terdaftar</label>
                    <p class="text-gray-900 font-medium mt-1">{{ $user->created_at->format('d F Y, H:i') }}</p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">Terakhir Update</label>
                    <p class="text-gray-900 font-medium mt-1">{{ $user->updated_at->format('d F Y, H:i') }}</p>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">Status</label>
                    <p class="text-gray-900 font-medium mt-1">
                        <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded text-sm">Aktif</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
