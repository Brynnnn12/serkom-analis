<?php

namespace App\Http\Controllers;

use App\Models\Penggunaan;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Controller untuk mengelola data penggunaan listrik pelanggan
 *
 * Modul ini menangani operasi CRUD untuk data penggunaan listrik,
 * termasuk perhitungan meter awal dari bulan sebelumnya dan validasi data.
 *
 * @package App\Http\Controllers
 */
class PenggunaanController extends Controller
{
    /**
     * Menampilkan daftar semua data penggunaan listrik
     *
     * Method ini mengambil semua data penggunaan beserta relasi pelanggan dan tagihan,
     * kemudian menampilkannya dalam view index penggunaan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $penggunaans = Penggunaan::with(['pelanggan.tarif', 'tagihan'])->latest()->get();
        return view('penggunaans.index', compact('penggunaans'));
    }

    /**
     * Mengambil meter awal dari penggunaan bulan sebelumnya
     *
     * Method ini digunakan untuk mendapatkan meter akhir dari bulan sebelumnya
     * sebagai meter awal untuk bulan saat ini. Algoritma pencarian:
     * 1. Validasi input id_pelanggan, bulan, dan tahun
     * 2. Cari penggunaan dengan tahun lebih kecil atau tahun sama tapi bulan lebih kecil
     * 3. Urutkan berdasarkan tahun dan bulan descending
     * 4. Ambil meter_ahir dari record pertama sebagai meter_awal
     *
     * @param \Illuminate\Http\Request $request Request berisi id_pelanggan, bulan, tahun
     * @return \Illuminate\Http\JsonResponse JSON response dengan meter_awal dan info bulan sebelumnya
     * @throws \Illuminate\Validation\ValidationException Jika validasi gagal
     */
    public function getPreviousMeter(Request $request)
    {
        $id_pelanggan = $request->input('id_pelanggan');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        if (!$id_pelanggan || !$bulan || !$tahun) {
            return response()->json(['error' => 'Missing required parameters'], 400);
        }

        // Ambil meter_awal dari penggunaan bulan sebelumnya
        $previousPenggunaan = Penggunaan::where('id_pelanggan', $id_pelanggan)
            ->where(function($query) use ($tahun, $bulan) {
                $query->where('tahun', '<', $tahun)
                    ->orWhere(function($q) use ($tahun, $bulan) {
                        $q->where('tahun', $tahun)
                          ->where('bulan', '<', $bulan);
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

    /**
     * Helper method untuk mendapatkan meter awal dari bulan sebelumnya
     *
     * @param int $id_pelanggan ID pelanggan
     * @param int $bulan Bulan target
     * @param int $tahun Tahun target
     * @return float Meter awal (0 jika tidak ada data sebelumnya)
     */
    private function getPreviousMeterValue($id_pelanggan, $bulan, $tahun)
    {
        $previousPenggunaan = Penggunaan::where('id_pelanggan', $id_pelanggan)
            ->where(function($query) use ($tahun, $bulan) {
                $query->where('tahun', '<', $tahun)
                    ->orWhere(function($q) use ($tahun, $bulan) {
                        $q->where('tahun', $tahun)
                          ->where('bulan', '<', $bulan);
                    });
            })
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->first();

        return $previousPenggunaan ? $previousPenggunaan->meter_ahir : 0;
    }

    /**
     * Helper method untuk mendapatkan meter awal dari bulan sebelumnya (exclude current record)
     *
     * @param int $id_pelanggan ID pelanggan
     * @param int $bulan Bulan target
     * @param int $tahun Tahun target
     * @param int $exclude_id ID penggunaan yang akan di-exclude
     * @return float Meter awal (0 jika tidak ada data sebelumnya)
     */
    private function getPreviousMeterValueExcludingCurrent($id_pelanggan, $bulan, $tahun, $exclude_id)
    {
        $previousPenggunaan = Penggunaan::where('id_pelanggan', $id_pelanggan)
            ->where('id_penggunaan', '!=', $exclude_id)
            ->where(function($query) use ($tahun, $bulan) {
                $query->where('tahun', '<', $tahun)
                    ->orWhere(function($q) use ($tahun, $bulan) {
                        $q->where('tahun', $tahun)
                          ->where('bulan', '<', $bulan);
                    });
            })
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->first();

        return $previousPenggunaan ? $previousPenggunaan->meter_ahir : 0;
    }

    /**
     * Menampilkan form untuk membuat penggunaan baru
     *
     * Method ini menampilkan form create penggunaan dengan daftar pelanggan
     * yang tersedia untuk dipilih.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $pelanggans = Pelanggan::all();
        return view('penggunaans.create', compact('pelanggans'));
    }

    /**
     * Menyimpan data penggunaan baru ke database
     *
     * Algoritma penyimpanan:
     * 1. Validasi input (id_pelanggan, bulan, tahun, meter_ahir)
     * 2. Cek duplikasi penggunaan untuk bulan/tahun yang sama
     * 3. Hitung meter_awal dari penggunaan bulan sebelumnya
     * 4. Validasi meter_ahir > meter_awal
     * 5. Hitung jumlah_meter = meter_ahir - meter_awal
     * 6. Simpan data penggunaan
     * 7. Hitung total tagihan berdasarkan tarif per kWh
     * 8. Buat tagihan otomatis dengan status 'Belum Bayar'
     *
     * @param \Illuminate\Http\Request $request Request berisi data penggunaan
     * @return \Illuminate\Http\RedirectResponse Redirect ke index dengan pesan sukses/error
     * @throws \Illuminate\Validation\ValidationException Jika validasi gagal
     */
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
        $meter_awal = $this->getPreviousMeterValue($request->id_pelanggan, $request->bulan, $request->tahun);

        // Validasi meter_ahir harus lebih besar dari meter_awal
        if ($request->meter_ahir <= $meter_awal) {
            return back()->withInput()->withErrors(['meter_ahir' => 'Meter akhir harus lebih besar dari meter awal (' . $meter_awal . ').']);
        }

        // Gunakan atomic transaction untuk memastikan konsistensi data
        $penggunaan = DB::transaction(function () use ($request, $meter_awal) {

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
        });

        return redirect()->route('penggunaans.index')->with('success', 'Penggunaan berhasil dicatat dan tagihan otomatis dibuat.');
    }

    /**
     * Menampilkan detail penggunaan tertentu
     *
     * Method ini menampilkan detail lengkap dari sebuah penggunaan
     * beserta relasi pelanggan, tarif, dan tagihan yang terkait.
     *
     * @param \App\Models\Penggunaan $penggunaan Instance model Penggunaan
     * @return \Illuminate\View\View
     */
    public function show(Penggunaan $penggunaan)
    {
        $penggunaan->load(['pelanggan.tarif', 'tagihan']);
        return view('penggunaans.show', compact('penggunaan'));
    }

    /**
     * Menampilkan form edit untuk penggunaan tertentu
     *
     * Method ini menampilkan form edit dengan data penggunaan yang akan diubah
     * dan daftar pelanggan yang tersedia.
     *
     * @param \App\Models\Penggunaan $penggunaan Instance model Penggunaan yang akan diedit
     * @return \Illuminate\View\View
     */
    public function edit(Penggunaan $penggunaan)
    {
        $pelanggans = Pelanggan::all();
        return view('penggunaans.edit', compact('penggunaan', 'pelanggans'));
    }

    /**
     * Memperbarui data penggunaan yang ada
     *
     * Algoritma update sama dengan store namun dengan pengecualian record sendiri:
     * 1. Validasi input (id_pelanggan, bulan, tahun, meter_ahir)
     * 2. Cek duplikasi dengan record lain untuk bulan/tahun yang sama
     * 3. Hitung ulang meter_awal dari penggunaan bulan sebelumnya (exclude current)
     * 4. Validasi meter_ahir > meter_awal
     * 5. Hitung ulang jumlah_meter = meter_ahir - meter_awal
     * 6. Update data penggunaan
     * 7. Update tagihan terkait dengan data baru
     *
     * @param \Illuminate\Http\Request $request Request berisi data update
     * @param \App\Models\Penggunaan $penggunaan Instance model yang akan diupdate
     * @return \Illuminate\Http\RedirectResponse Redirect ke index dengan pesan sukses/error
     * @throws \Illuminate\Validation\ValidationException Jika validasi gagal
     */
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

        // Gunakan atomic transaction untuk memastikan konsistensi data
        DB::transaction(function () use ($request, $penggunaan) {
            // Ambil meter_awal dari penggunaan bulan sebelumnya (exclude current)
            $meter_awal = $this->getPreviousMeterValueExcludingCurrent($request->id_pelanggan, $request->bulan, $request->tahun, $penggunaan->getKey());

            // Validasi meter_ahir harus lebih besar dari meter_awal
            if ($request->meter_ahir <= $meter_awal) {
                throw new \Exception('Meter akhir harus lebih besar dari meter awal (' . $meter_awal . ').');
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
        });

        return redirect()->route('penggunaans.index')->with('success', 'Penggunaan berhasil diperbarui.');
    }

    /**
     * Menghapus data penggunaan dan tagihan terkait
     *
     * Method ini menghapus data penggunaan beserta tagihan yang terkait.
     * Algoritma penghapusan:
     * 1. Hapus semua tagihan yang terkait dengan penggunaan ini
     * 2. Hapus data penggunaan
     *
     * @param \App\Models\Penggunaan $penggunaan Instance model yang akan dihapus
     * @return \Illuminate\Http\RedirectResponse Redirect ke index dengan pesan sukses
     */
    public function destroy(Penggunaan $penggunaan)
    {
        // Hapus tagihan yang terkait terlebih dahulu
        Tagihan::where('id_penggunaan', $penggunaan->getKey())->delete();

        // Hapus penggunaan
        $penggunaan->delete();

        return redirect()->route('penggunaans.index')->with('success', 'Penggunaan berhasil dihapus.');
    }
}
