<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::all();
        return view('tarifs.index', compact('tarifs'));
    }

    public function create()
    {
        return view('tarifs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'daya' => 'required|string',
            'tarifperkwh' => 'required|numeric|min:0',
        ]);

        Tarif::create($request->all());

        return redirect()->route('tarifs.index')->with('success', 'Tarif berhasil ditambahkan.');
    }

    public function show(Tarif $tarif)
    {
        return view('tarifs.show', compact('tarif'));
    }

    public function edit(Tarif $tarif)
    {
        return view('tarifs.edit', compact('tarif'));
    }

    public function update(Request $request, Tarif $tarif)
    {
        $request->validate([
            'daya' => 'required|string',
            'tarifperkwh' => 'required|numeric|min:0',
        ]);

        $tarif->update($request->all());

        return redirect()->route('tarifs.index')->with('success', 'Tarif berhasil diperbarui.');
    }

    public function destroy(Tarif $tarif)
    {
        $tarif->delete();

        return redirect()->route('tarifs.index')->with('success', 'Tarif berhasil dihapus.');
    }
}
