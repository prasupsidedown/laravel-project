<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TripController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/agen', function () {
    return view('daftar_agen');
});

Route::resource('trips', TripController::class);

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Reset Password (opsional, bisa kamu isi nanti)
Route::get('/password/reset', function () {
    return "Halaman reset password (belum dibuat)";
})->name('password.request');
