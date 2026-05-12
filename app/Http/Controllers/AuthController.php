<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function processLogin(Request $request)
    {
        // Simulasi proses login berhasil, arahkan langsung ke dashboard mitra
        return redirect()->route('mitra.dashboard')->with('success', 'Selamat datang kembali!');
    }

    public function processRegister(Request $request)
    {
        // Simulasi proses daftar berhasil
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}
