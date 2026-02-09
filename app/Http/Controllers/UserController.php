<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('level')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $levels = Level::all();
        return view('users.create', compact('levels'));
    }

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

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $levels = Level::all();
        return view('users.edit', compact('user', 'levels'));
    }

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
