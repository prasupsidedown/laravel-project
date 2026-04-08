<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.auth'); // sesuaikan dengan nama file blade kamu
    }

    // Proses login (sementara)
    public function login(Request $request)
    {
        return "Login berhasil (sementara)";
    }

    // Tampilkan halaman register
    public function showRegister()
    {
        return view('register'); // sesuaikan juga
    }

    // Proses register (sementara)
    public function register(Request $request)
    {
        return "Register berhasil (sementara)";
    }
}