<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/auth/user', [AuthController::class, 'getAuthUser'])->middleware('auth:sanctum');
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/token', [AuthController::class, 'generateToken']);
Route::post('/auth/revoke', [AuthController::class, 'revokeAuthTokens'])->middleware('auth:sanctum');
