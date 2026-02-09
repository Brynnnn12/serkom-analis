<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Controller untuk mengelola data admin/user sistem
 *
 * Modul ini menangani operasi CRUD untuk data admin dengan level akses,
 * termasuk hashing password dan validasi keamanan.
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Menampilkan daftar semua admin/user
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::with('level')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat admin baru
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $levels = Level::all();
        return view('users.create', compact('levels'));
    }

    /**
     * Menyimpan data admin baru ke database
     *
     * Algoritma penyimpanan:
     * 1. Validasi input (nama_admin, username unik, password min 6 karakter, id_level)
     * 2. Hash password menggunakan Hash::make()
     * 3. Simpan data admin baru
     *
     * @param \Illuminate\Http\Request $request Request berisi data admin baru
     * @return \Illuminate\Http\RedirectResponse Redirect ke index dengan pesan sukses
     * @throws \Illuminate\Validation\ValidationException Jika validasi gagal
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'id_level' => 'required|exists:levels,id_level',
        ]);

        User::create([
            'nama_admin' => $request->nama_admin,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'id_level' => $request->id_level,
        ]);

        return redirect()->route('users.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail admin tertentu
     *
     * @param \App\Models\User $user Instance model User
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Menampilkan form edit untuk admin tertentu
     *
     * @param \App\Models\User $user Instance model User yang akan diedit
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $levels = Level::all();
        return view('users.edit', compact('user', 'levels'));
    }

    /**
     * Memperbarui data admin yang ada
     *
     * Algoritma update:
     * 1. Validasi input dengan exception untuk username unik (exclude current user)
     * 2. Password bersifat opsional - hanya diupdate jika diisi
     * 3. Hash password baru jika ada perubahan
     * 4. Update data admin
     *
     * @param \Illuminate\Http\Request $request Request berisi data update
     * @param \App\Models\User $user Instance model yang akan diupdate
     * @return \Illuminate\Http\RedirectResponse Redirect ke index dengan pesan sukses
     * @throws \Illuminate\Validation\ValidationException Jika validasi gagal
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama_admin' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $user->getKey() . ',id_user',
            'id_level' => 'required|exists:levels,id_level',
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'nama_admin' => $request->nama_admin,
            'username' => $request->username,
            'id_level' => $request->id_level,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Admin berhasil diperbarui.');
    }

    /**
     * Menghapus data admin
     *
     * Algoritma penghapusan:
     * 1. Cek apakah user yang akan dihapus adalah user yang sedang login
     * 2. Jika ya, tolak penghapusan dengan pesan error
     * 3. Jika tidak, hapus data admin
     *
     * @param \App\Models\User $user Instance model yang akan dihapus
     * @return \Illuminate\Http\RedirectResponse Redirect ke index dengan pesan sukses/error
     */
    public function destroy(User $user)
    {
        // Prevent deleting own account
        if ($user->getKey() == auth()->guard('web')->id()) {
            return redirect()->route('users.index')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Admin berhasil dihapus.');
    }
}
