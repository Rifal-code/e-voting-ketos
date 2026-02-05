<?php

use App\Http\Controllers\Auth\AuthController;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    // Ambil semua data kelas dari database
    $classes = SchoolClass::all(); 
    
    // Kirim variabel $classes ke file blade
    return view('auth.register', compact('classes'));
})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/results', function () {
    return view('pages.results');
})->name('results');

Route::get('/dashboard/candidates', function () {
    return view('admin.candidate');
})->name('dashboard.candidates');