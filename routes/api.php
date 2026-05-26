<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/agen', [AgenController::class, 'index']);
    Route::post('/agen', [AgenController::class, 'store']);
    Route::get('/search', [SearchController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});