<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::with('tarif')->get();
        return view('pelanggans.index', compact('pelanggans'));
    }

    public function create()
    {
        $tarifs = Tarif::all();
        return view('pelanggans.create', compact('tarifs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nomor_kwh' => 'required|string|min:10|unique:pelanggans',
            'alamat' => 'required|string',
            'id_tarif' => 'required|exists:tarifs,id_tarif',
            'username' => 'required|string|unique:pelanggans',
            'password' => 'required|string|min:6',
        ]);

        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'nomor_kwh' => $request->nomor_kwh,
            'alamat' => $request->alamat,
            'id_tarif' => $request->id_tarif,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function show(Pelanggan $pelanggan)
    {
        return view('pelanggans.show', compact('pelanggan'));
    }

    public function edit(Pelanggan $pelanggan)
    {
        $tarifs = Tarif::all();
        return view('pelanggans.edit', compact('pelanggan', 'tarifs'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'nomor_kwh' => 'required|string|unique:pelanggans,nomor_kwh,' . $pelanggan->getKey() . ',id_pelanggan',
            'alamat' => 'required|string',
            'id_tarif' => 'required|exists:tarifs,id_tarif',
            'username' => 'required|string|unique:pelanggans,username,' . $pelanggan->getKey() . ',id_pelanggan',
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'nama_pelanggan' => $request->nama_pelanggan,
            'nomor_kwh' => $request->nomor_kwh,
            'alamat' => $request->alamat,
            'id_tarif' => $request->id_tarif,
            'username' => $request->username,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pelanggan->update($data);

        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
