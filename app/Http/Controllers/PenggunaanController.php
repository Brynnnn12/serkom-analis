<?php

namespace App\Http\Controllers;

use App\Models\Penggunaan;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PenggunaanController extends Controller
{
    public function index()
    {
        $penggunaans = Penggunaan::with(['pelanggan.tarif', 'tagihan'])->latest()->get();
        return view('penggunaans.index', compact('penggunaans'));
    }

    public function getPreviousMeter(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 1),
        ]);

        // Ambil meter_awal dari penggunaan bulan sebelumnya
        $previousPenggunaan = Penggunaan::where('id_pelanggan', $request->id_pelanggan)
            ->where(function($query) use ($request) {
                $query->where('tahun', '<', $request->tahun)
                    ->orWhere(function($q) use ($request) {
                        $q->where('tahun', $request->tahun)
                          ->where('bulan', '<', $request->bulan);
                    });
            })
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->first();

        $meter_awal = $previousPenggunaan ? $previousPenggunaan->meter_ahir : 0;

        return response()->json([
            'meter_awal' => $meter_awal,
            'bulan_sebelumnya' => $previousPenggunaan ? $previousPenggunaan->bulan . '/' . $previousPenggunaan->tahun : null
        ]);
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        return view('penggunaans.create', compact('pelanggans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'meter_ahir' => 'required|numeric|min:0',
        ]);

        // Cek apakah sudah ada penggunaan untuk bulan/tahun ini
        $existing = Penggunaan::where('id_pelanggan', $request->id_pelanggan)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();

        if ($existing) {
            return back()->withInput()->withErrors(['bulan' => 'Penggunaan untuk bulan ini sudah ada.']);
        }

        // Ambil meter_awal dari penggunaan bulan sebelumnya
        $previousPenggunaan = Penggunaan::where('id_pelanggan', $request->id_pelanggan)
            ->where(function($query) use ($request) {
                $query->where('tahun', '<', $request->tahun)
                    ->orWhere(function($q) use ($request) {
                        $q->where('tahun', $request->tahun)
                          ->where('bulan', '<', $request->bulan);
                    });
            })
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->first();

        $meter_awal = $previousPenggunaan ? $previousPenggunaan->meter_ahir : 0;

        // Validasi meter_ahir harus lebih besar dari meter_awal
        if ($request->meter_ahir <= $meter_awal) {
            return back()->withInput()->withErrors(['meter_ahir' => 'Meter akhir harus lebih besar dari meter awal (' . $meter_awal . ').']);
        }

        // Hitung jumlah meter
        $jumlah_meter = $request->meter_ahir - $meter_awal;

        // Simpan penggunaan
        $penggunaan = Penggunaan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'meter_awal' => $meter_awal,
            'meter_ahir' => $request->meter_ahir,
        ]);

        // Ambil data pelanggan dan tarif
        $pelanggan = Pelanggan::with('tarif')->find($request->id_pelanggan);
        $tarif_per_kwh = $pelanggan->tarif->tarifperkwh ?? 0;

        // Hitung total tagihan
        $total_tagihan = $jumlah_meter * $tarif_per_kwh;

        // Buat tagihan otomatis
        Tagihan::create([
            'id_penggunaan' => $penggunaan->id_penggunaan,
            'id_pelanggan' => $request->id_pelanggan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'jumlah_meter' => $jumlah_meter,
            'status' => 'Belum Bayar',
        ]);

        return redirect()->route('penggunaans.index')->with('success', 'Penggunaan berhasil dicatat dan tagihan otomatis dibuat.');
    }

    public function show(Penggunaan $penggunaan)
    {
        $penggunaan->load(['pelanggan.tarif', 'tagihan']);
        return view('penggunaans.show', compact('penggunaan'));
    }

    public function edit(Penggunaan $penggunaan)
    {
        $pelanggans = Pelanggan::all();
        return view('penggunaans.edit', compact('penggunaan', 'pelanggans'));
    }

    public function update(Request $request, Penggunaan $penggunaan)
    {
        $request->validate([
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'meter_ahir' => 'required|numeric|min:0',
        ]);

        // Cek apakah sudah ada penggunaan lain untuk bulan/tahun ini
        $existing = Penggunaan::where('id_pelanggan', $request->id_pelanggan)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->where('id_penggunaan', '!=', $penggunaan->getKey())
            ->first();

        if ($existing) {
            return back()->withInput()->withErrors(['bulan' => 'Penggunaan untuk bulan ini sudah ada.']);
        }

        // Ambil meter_awal dari penggunaan bulan sebelumnya
        $previousPenggunaan = Penggunaan::where('id_pelanggan', $request->id_pelanggan)
            ->where(function($query) use ($request) {
                $query->where('tahun', '<', $request->tahun)
                    ->orWhere(function($q) use ($request) {
                        $q->where('tahun', $request->tahun)
                          ->where('bulan', '<', $request->bulan);
                    });
            })
            ->where('id_penggunaan', '!=', $penggunaan->getKey())
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->first();

        $meter_awal = $previousPenggunaan ? $previousPenggunaan->meter_ahir : 0;

        // Validasi meter_ahir harus lebih besar dari meter_awal
        if ($request->meter_ahir <= $meter_awal) {
            return back()->withInput()->withErrors(['meter_ahir' => 'Meter akhir harus lebih besar dari meter awal (' . $meter_awal . ').']);
        }

        // Hitung jumlah meter
        $jumlah_meter = $request->meter_ahir - $meter_awal;

        // Update penggunaan
        $penggunaan->update([
            'id_pelanggan' => $request->id_pelanggan,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'meter_awal' => $meter_awal,
            'meter_ahir' => $request->meter_ahir,
        ]);

        // Update tagihan yang terkait
        $tagihan = Tagihan::where('id_penggunaan', $penggunaan->getKey())->first();
        if ($tagihan) {
            $pelanggan = Pelanggan::with('tarif')->find($request->id_pelanggan);
            $tarif_per_kwh = $pelanggan->tarif->tarifperkwh ?? 0;
            $total_tagihan = $jumlah_meter * $tarif_per_kwh;

            $tagihan->update([
                'id_pelanggan' => $request->id_pelanggan,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'jumlah_meter' => $jumlah_meter,
            ]);
        }

        return redirect()->route('penggunaans.index')->with('success', 'Penggunaan berhasil diperbarui.');
    }

    public function destroy(Penggunaan $penggunaan)
    {
        // Hapus tagihan yang terkait terlebih dahulu
        Tagihan::where('id_penggunaan', $penggunaan->getKey())->delete();

        // Hapus penggunaan
        $penggunaan->delete();

        return redirect()->route('penggunaans.index')->with('success', 'Penggunaan berhasil dihapus.');
    }
}
