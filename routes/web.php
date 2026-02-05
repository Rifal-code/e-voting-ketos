<?php

use App\Models\Candidate;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\CandidateController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', [AuthController::class, 'home'])->name('home');

    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/', fn () => view('admin.dashboard'))->name('admin.dashboard');

        Route::get('/candidates', [CandidateController::class, 'index'])->name('admin.candidates');
        Route::get('/candidates/create', [CandidateController::class, 'create'])->name('admin.candidates.create');
        Route::post('/candidates/create', [CandidateController::class, 'store'])->name('admin.candidates.store');
        Route::get('/candidate/edit/{candidate}', [CandidateController::class, 'edit'])->name('admin.candidates.edit');
        Route::put('/candidate/edit/{candidate}', [CandidateController::class, 'update'])->name('admin.candidates.update');
        Route::delete('/candidates/delete/{candidate}', [CandidateController::class, 'destroy'])->name('admin.candidates.destroy');

         Route::get('/classes', [ClassController::class, 'index'])->name('admin.classes');
        Route::get('/classes/create', [ClassController::class, 'create'])->name('admin.classes.create');
        Route::post('/classes/create', [ClassController::class, 'store'])->name('admin.classes.store');
        Route::get('/class/edit/{class}', [ClassController::class, 'edit'])->name('admin.classes.edit');
        Route::put('/class/edit/{class}', [ClassController::class, 'update'])->name('admin.classes.update');
        Route::delete('/classes/delete/{class}', [ClassController::class, 'destroy'])->name('admin.classes.destroy');

        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    Route::prefix('voter')->middleware('role:voter')->group(function() {
        Route::get('/', fn () => view('voter.dashboard'))->name('voter.dashboard');
    });
});

Route::get('/results', function () {
    return view('pages.results');
})->name('results');