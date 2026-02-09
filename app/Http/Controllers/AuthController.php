<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm(Request $request)
    {
        // Jika sudah login sebagai admin, redirect ke dashboard admin
        if (Auth::guard('web')->check()) {
            return redirect('/admin/dashboard');
        }

        // Jika sudah login sebagai pelanggan, redirect ke dashboard pelanggan
        if (Auth::guard('pelanggan')->check()) {

            return redirect('/pelanggan/dashboard');
        }

        Log::info('Tampilkan form login');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        // Coba login sebagai admin (users)
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect('/admin/dashboard');
        }

        // Coba login sebagai pelanggan (pelanggans)
        if (Auth::guard('pelanggan')->attempt($credentials)) {
            return redirect('/pelanggan/dashboard');
        }
        // Jika gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        // Logout dari guard yang aktif
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('pelanggan')->check()) {
            Auth::guard('pelanggan')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
