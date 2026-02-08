<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Voter\VoteController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('pages.index');
});
Route::get('/results', [VoteController::class, 'results'])->name('results');

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
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

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
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users/create', [UserController::class, 'store'])->name('admin.users.store');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

    Route::prefix('voter')->middleware('role:voter')->group(function() {
        Route::get('/', [VoteController::class, 'index'])->name('voter.dashboard');
         Route::post('/voter/{candidate}/vote', [VoteController::class, 'store'])->name('voter.store');
    });
});

