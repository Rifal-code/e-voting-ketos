<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CandidateController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoteController;
use Illuminate\Support\Facades\Route;


// Public routes (tanpa autentikasi)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/classes', [ClassController::class, 'index']);
Route::get('/classes/{class}', [ClassController::class, 'show']);

Route::get('/candidates', [CandidateController::class, 'index']);
Route::get('/candidates/{candidate}', [CandidateController::class, 'show']);

Route::get('/votes/results', [VoteController::class, 'results']);

// Protected routes (memerlukan autentikasi)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [UserController::class, 'me']);

    // Voting
    Route::post('/votes', [VoteController::class, 'store']);
    Route::get('/votes/status', [VoteController::class, 'status']);

    // Admin only routes
    Route::middleware('admin')->group(function () {
        // Classes CRUD (kecuali index & show yang public)
        Route::post('/classes', [ClassController::class, 'store']);
        Route::put('/classes/{class}', [ClassController::class, 'update']);
        Route::delete('/classes/{class}', [ClassController::class, 'destroy']);

        // Candidates CRUD (kecuali index & show yang public)
        Route::post('/candidates', [CandidateController::class, 'store']);
        Route::put('/candidates/{candidate}', [CandidateController::class, 'update']);
        Route::delete('/candidates/{candidate}', [CandidateController::class, 'destroy']);

        // Users management
        Route::get('/users', [UserController::class, 'index']);
    });
});


