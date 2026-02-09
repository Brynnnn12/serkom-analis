<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

/**
 * Controller untuk mengelola tagihan listrik
 *
 * Modul ini menangani:
 * - Menampilkan daftar tagihan dengan filtering berdasarkan guard
 * - Menampilkan detail tagihan
 * - Tagihan dibuat otomatis oleh PenggunaanController
 *
 * @package App\Http\Controllers
 */
class TagihanController extends Controller
{
    /**
     * Menampilkan daftar tagihan
     *
     * Admin dapat melihat semua tagihan dengan filter status, bulan, tahun.
     * Pelanggan hanya dapat melihat tagihan miliknya sendiri.
     *
     * @param Request $request Parameter filter (status, bulan, tahun)
     * @return \Illuminate\View\View
     */
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

    /**
     * Menampilkan form create tagihan
     *
     * Tagihan dibuat otomatis, jadi redirect ke index dengan pesan error.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        // Tagihan dibuat otomatis oleh PenggunaanController
        return redirect()->route('tagihans.index')->with('error', 'Tagihan dibuat otomatis saat input penggunaan.');
    }

    /**
     * Menyimpan tagihan baru
     *
     * Tagihan dibuat otomatis, jadi method ini tidak digunakan.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Tagihan dibuat otomatis oleh PenggunaanController
        return redirect()->route('tagihans.index')->with('error', 'Tagihan dibuat otomatis saat input penggunaan.');
    }

    /**
     * Menampilkan detail tagihan
     *
     * @param Tagihan $tagihan Instance model Tagihan
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException Jika pelanggan mengakses tagihan orang lain
     */
    public function show(Tagihan $tagihan)
    {
        // Cek akses: admin bisa lihat semua, pelanggan hanya tagihan sendiri
        if (auth()->guard('pelanggan')->check() && $tagihan->id_pelanggan !== auth()->guard('pelanggan')->id()) {
            abort(403, 'Unauthorized');
        }

        $tagihan->load(['pelanggan.tarif', 'penggunaan', 'pembayaran']);
        return view('tagihans.show', compact('tagihan'));
    }

    /**
     * Menampilkan form edit tagihan
     *
     * Tagihan tidak bisa diedit manual, hanya melalui penggunaan
     *
     * @param Tagihan $tagihan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Tagihan $tagihan)
    {
        // Tagihan tidak bisa diedit manual, hanya melalui penggunaan
        return redirect()->route('tagihans.index')->with('error', 'Tagihan tidak bisa diedit manual. Edit melalui menu Penggunaan.');
    }

    /**
     * Update tagihan
     *
     * Tagihan tidak bisa diupdate manual
     *
     * @param Request $request
     * @param Tagihan $tagihan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Tagihan $tagihan)
    {
        // Tagihan tidak bisa diupdate manual
        return redirect()->route('tagihans.index')->with('error', 'Tagihan tidak bisa diupdate manual.');
    }

    /**
     * Hapus tagihan
     *
     * Tagihan dihapus otomatis saat penggunaan dihapus
     *
     * @param Tagihan $tagihan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Tagihan $tagihan)
    {
        // Tagihan dihapus otomatis saat penggunaan dihapus
        return redirect()->route('tagihans.index')->with('error', 'Tagihan dihapus otomatis saat penggunaan dihapus.');
    }
}
