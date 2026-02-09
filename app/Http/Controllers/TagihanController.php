<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index(Request $request)
    {
        // Cek guard yang digunakan
        if (auth()->guard('web')->check()) {
            // Admin: Lihat semua tagihan dengan filter
            $query = Tagihan::with(['pelanggan.tarif', 'penggunaan']);

            // Filter berdasarkan status
            if ($request->has('status') && $request->status !== '') {
                $query->where('status', $request->status);
            }

            // Filter berdasarkan bulan/tahun
            if ($request->has('bulan') && $request->bulan !== '') {
                $query->where('bulan', $request->bulan);
            }

            if ($request->has('tahun') && $request->tahun !== '') {
                $query->where('tahun', $request->tahun);
            }

            $tagihans = $query->latest()->get();
            $isAdmin = true;
        } else {
            // Pelanggan: Lihat tagihan sendiri
            $tagihans = Tagihan::with(['pelanggan.tarif', 'penggunaan'])
                ->where('id_pelanggan', auth()->guard('pelanggan')->id())
                ->latest()
                ->get();
            $isAdmin = false;
        }

        return view('tagihans.index', compact('tagihans', 'isAdmin'));
    }

    public function create()
    {
        // Tagihan dibuat otomatis oleh PenggunaanController
        return redirect()->route('tagihans.index')->with('error', 'Tagihan dibuat otomatis saat input penggunaan.');
    }

    public function store(Request $request)
    {
        // Tagihan dibuat otomatis oleh PenggunaanController
        return redirect()->route('tagihans.index')->with('error', 'Tagihan dibuat otomatis saat input penggunaan.');
    }

    public function show(Tagihan $tagihan)
    {
        // Cek akses: admin bisa lihat semua, pelanggan hanya tagihan sendiri
        if (auth()->guard('pelanggan')->check() && $tagihan->id_pelanggan !== auth()->guard('pelanggan')->id()) {
            abort(403, 'Unauthorized');
        }

        $tagihan->load(['pelanggan.tarif', 'penggunaan', 'pembayaran']);
        return view('tagihans.show', compact('tagihan'));
    }

    public function edit(Tagihan $tagihan)
    {
        // Tagihan tidak bisa diedit manual, hanya melalui penggunaan
        return redirect()->route('tagihans.index')->with('error', 'Tagihan tidak bisa diedit manual. Edit melalui menu Penggunaan.');
    }

    public function update(Request $request, Tagihan $tagihan)
    {
        // Tagihan tidak bisa diupdate manual
        return redirect()->route('tagihans.index')->with('error', 'Tagihan tidak bisa diupdate manual.');
    }

    public function destroy(Tagihan $tagihan)
    {
        // Tagihan dihapus otomatis saat penggunaan dihapus
        return redirect()->route('tagihans.index')->with('error', 'Tagihan dihapus otomatis saat penggunaan dihapus.');
    }
}
