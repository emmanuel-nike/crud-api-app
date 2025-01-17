<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/token', [AuthController::class, 'generateToken']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Protected Auth API routes
    Route::get('/auth/user', [AuthController::class, 'getAuthUser']);
    Route::post('/auth/revoke', [AuthController::class, 'revokeAuthTokens']);

    // Protected Post API routes
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{post}', [PostController::class, 'show']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
});
