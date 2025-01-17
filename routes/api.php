<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\LogMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'register'])->middleware(LogMiddleware::class);
Route::post('/auth/token', [AuthController::class, 'generateToken'])->middleware(LogMiddleware::class);

Route::middleware(['auth:sanctum', 'throttle:lim_user_10pm', LogMiddleware::class])->group(function () {
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

Route::get('/activities', [ActivityController::class, 'index']);
