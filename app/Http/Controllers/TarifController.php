<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

/**
 * Controller untuk mengelola data tarif listrik berdasarkan daya
 *
 * Modul ini menangani operasi CRUD untuk data tarif yang menentukan
 * harga per kWh berdasarkan daya listrik pelanggan.
 *
 * @package App\Http\Controllers
 */
class TarifController extends Controller
{
    /**
     * Menampilkan daftar semua tarif listrik
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $tarifs = Tarif::all();
        return view('tarifs.index', compact('tarifs'));
    }

    /**
     * Menampilkan form untuk membuat tarif baru
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tarifs.create');
    }

    /**
     * Menyimpan data tarif baru ke database
     *
     * @param \Illuminate\Http\Request $request Request berisi daya dan tarifperkwh
     * @return \Illuminate\Http\RedirectResponse Redirect ke index dengan pesan sukses
     * @throws \Illuminate\Validation\ValidationException Jika validasi gagal
     */
    public function store(Request $request)
    {
        $request->validate([
            'daya' => 'required|string',
            'tarifperkwh' => 'required|numeric|min:0',
        ]);

        Tarif::create($request->all());

        return redirect()->route('tarifs.index')->with('success', 'Tarif berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail tarif tertentu
     *
     * @param \App\Models\Tarif $tarif Instance model Tarif
     * @return \Illuminate\View\View
     */
    public function show(Tarif $tarif)
    {
        return view('tarifs.show', compact('tarif'));
    }

    /**
     * Menampilkan form edit untuk tarif tertentu
     *
     * @param \App\Models\Tarif $tarif Instance model Tarif yang akan diedit
     * @return \Illuminate\View\View
     */
    public function edit(Tarif $tarif)
    {
        return view('tarifs.edit', compact('tarif'));
    }

    /**
     * Memperbarui data tarif yang ada
     *
     * @param \Illuminate\Http\Request $request Request berisi data update
     * @param \App\Models\Tarif $tarif Instance model yang akan diupdate
     * @return \Illuminate\Http\RedirectResponse Redirect ke index dengan pesan sukses
     * @throws \Illuminate\Validation\ValidationException Jika validasi gagal
     */
    public function update(Request $request, Tarif $tarif)
    {
        $request->validate([
            'daya' => 'required|string',
            'tarifperkwh' => 'required|numeric|min:0',
        ]);

        $tarif->update($request->all());

        return redirect()->route('tarifs.index')->with('success', 'Tarif berhasil diperbarui.');
    }

    /**
     * Menghapus data tarif
     *
     * @param \App\Models\Tarif $tarif Instance model yang akan dihapus
     * @return \Illuminate\Http\RedirectResponse Redirect ke index dengan pesan sukses
     */
    public function destroy(Tarif $tarif)
    {
        $tarif->delete();

        return redirect()->route('tarifs.index')->with('success', 'Tarif berhasil dihapus.');
    }
}
