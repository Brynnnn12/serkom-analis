<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Controller untuk menangani autentikasi pengguna (Admin dan Pelanggan)
 *
 * Modul ini bertanggung jawab untuk:
 * - Menampilkan form login
 * - Memproses login untuk dua guard berbeda (web untuk admin, pelanggan untuk customer)
 * - Menangani logout
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * Menampilkan form login
     *
     * Mengecek apakah pengguna sudah login, jika ya redirect ke dashboard masing-masing.
     * Jika belum, tampilkan form login.
     *
     * @param Request $request Objek request HTTP
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
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

    /**
     * Memproses login pengguna
     *
     * Validasi input username dan password, kemudian coba autentikasi
     * terhadap guard 'web' (admin) dan 'pelanggan' (customer).
     * Redirect ke dashboard sesuai role jika berhasil.
     *
     * @param Request $request Objek request dengan input username dan password
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException Jika validasi gagal
     */
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

    /**
     * Menangani logout pengguna
     *
     * Logout dari guard yang aktif (web atau pelanggan),
     * invalidate session, dan redirect ke home.
     *
     * @param Request $request Objek request HTTP
     * @return \Illuminate\Http\RedirectResponse
     */
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
