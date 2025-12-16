<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\MahasiswaDashboardController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminDiscussionController;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return view('home');
});

// Contact Form Route
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

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
    Route::resource('users', UserController::class);
    Route::resource('courses', CourseController::class);
    Route::get('/discussions', [AdminDiscussionController::class, 'index'])->name('discussions.index');
    Route::delete('/discussions/{discussion}', [AdminDiscussionController::class, 'destroy'])->name('discussions.destroy');
});

// Mahasiswa Routes
Route::middleware(['auth', CheckRole::class . ':mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/courses/{course}/materials', [MahasiswaDashboardController::class, 'courseMaterials'])->name('courses.materials');
    Route::get('/materials', [MahasiswaDashboardController::class, 'materials'])->name('materials');
    Route::get('/materials/{material}', [MahasiswaDashboardController::class, 'show'])->name('materials.show');

    // Discussion Routes
    Route::post('/materials/{material}/discussions', [DiscussionController::class, 'store'])->name('discussions.store');
    Route::delete('/discussions/{discussion}', [DiscussionController::class, 'destroy'])->name('discussions.destroy');
});
