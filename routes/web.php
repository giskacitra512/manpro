<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\MahasiswaDashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\DiscussionController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('home');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', CheckRole::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('materials', MaterialController::class);
});

// Mahasiswa Routes
Route::middleware(['auth', CheckRole::class . ':mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/materials', [MahasiswaDashboardController::class, 'materials'])->name('materials');
    Route::get('/materials/{material}', [MahasiswaDashboardController::class, 'show'])->name('materials.show');
    
    // Discussion Routes
    Route::post('/materials/{material}/discussions', [DiscussionController::class, 'store'])->name('discussions.store');
    Route::delete('/discussions/{discussion}', [DiscussionController::class, 'destroy'])->name('discussions.destroy');
});
