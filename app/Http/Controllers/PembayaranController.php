<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        // Cek guard yang digunakan
        if (auth()->guard('web')->check()) {
            // Admin: Lihat semua pembayaran dengan filter
            $query = Pembayaran::with(['tagihan.pelanggan', 'user']);

            // Filter berdasarkan bulan/tahun
            if ($request->has('bulan') && $request->bulan !== '') {
                $query->where('bulan_bayar', $request->bulan);
            }

            if ($request->has('tahun') && $request->tahun !== '') {
                $query->where('tahun_bayar', $request->tahun);
            }

            $pembayarans = $query->latest('tanggal_pembayaran')->get();
            $isAdmin = true;
        } else {
            // Pelanggan: Lihat history pembayaran sendiri
            $pembayarans = Pembayaran::with(['tagihan.pelanggan', 'user'])
                ->whereHas('tagihan', function($query) {
                    $query->where('id_pelanggan', auth()->guard('pelanggan')->id());
                })
                ->latest('tanggal_pembayaran')
                ->get();
            $isAdmin = false;
        }

        return view('pembayarans.index', compact('pembayarans', 'isAdmin'));
    }

    public function create(Request $request)
    {
        // Admin: Form pembayaran untuk tagihan tertentu
        if (!auth()->guard('web')->check()) {
            abort(403, 'Unauthorized');
        }

        $tagihan = null;
        $tagihans = collect();
        $pelanggan = null;

        // Jika ada pencarian berdasarkan ID pelanggan
        if ($request->has('id_pelanggan') && $request->id_pelanggan) {
            $pelanggan = \App\Models\Pelanggan::find($request->id_pelanggan);

            if ($pelanggan) {
                $tagihans = Tagihan::with(['pelanggan.tarif', 'penggunaan'])
                    ->where('id_pelanggan', $request->id_pelanggan)
                    ->where('status', 'Belum Bayar')
                    ->orderBy('tahun', 'desc')
                    ->orderBy('bulan', 'desc')
                    ->get();
            }
        }

        // Jika ada tagihan_id spesifik (dari link detail)
        if ($request->has('tagihan_id')) {
            $tagihan = Tagihan::with(['pelanggan.tarif', 'penggunaan'])
                ->where('id_tagihan', $request->tagihan_id)
                ->where('status', 'Belum Bayar')
                ->first();

            if (!$tagihan) {
                return redirect()->route('pembayarans.create')->with('error', 'Tagihan tidak ditemukan atau sudah dibayar.');
            }
        }

        return view('pembayarans.create', compact('tagihan', 'tagihans', 'pelanggan'));
    }

    public function store(Request $request)
    {
        if (!auth()->guard('web')->check()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'id_tagihan' => 'required|exists:tagihans,id_tagihan',
            'uang_dibayar' => 'required|numeric|min:0',
            'biaya_admin' => 'required|numeric|min:0',
        ]);

        // Ambil tagihan
        $tagihan = Tagihan::with('pelanggan.tarif')->findOrFail($request->id_tagihan);

        // Pastikan tagihan belum dibayar
        if ($tagihan->status === 'Terbayar') {
            return back()->withInput()->withErrors(['id_tagihan' => 'Tagihan ini sudah dibayar.']);
        }

        // Hitung total tagihan
        $total_tagihan = $tagihan->jumlah_meter * ($tagihan->pelanggan->tarif->tarifperkwh ?? 0);
        $total_bayar = $total_tagihan + $request->biaya_admin;

        // Validasi uang dibayar cukup
        if ($request->uang_dibayar < $total_bayar) {
            return back()->withInput()->withErrors(['uang_dibayar' => 'Uang yang dibayar kurang. Total yang harus dibayar: Rp ' . number_format($total_bayar, 0, ',', '.')]);
        }

        // Hitung kembalian
        $kembalian = $request->uang_dibayar - $total_bayar;

        // Simpan pembayaran
        $pembayaran = Pembayaran::create([
            'id_tagihan' => $request->id_tagihan,
            'id_pelanggan' => $tagihan->id_pelanggan,
            'id_user' => auth()->guard('web')->id(),
            'tanggal_pembayaran' => Carbon::now(),
            'bulan_bayar' => $tagihan->bulan,
            'biaya_admin' => $request->biaya_admin,
            'total_bayar' => $total_bayar,
            'uang_dibayar' => $request->uang_dibayar,
            'kembalian' => $kembalian,
        ]);

        // Update status tagihan menjadi Terbayar
        $tagihan->update(['status' => 'Terbayar']);

        return redirect()->route('pembayarans.show', $pembayaran)->with('success', 'Pembayaran berhasil diproses.');
    }

    public function show(Pembayaran $pembayaran)
    {
        // Cek akses: admin bisa lihat semua, pelanggan hanya pembayaran tagihan mereka
        if (auth()->guard('pelanggan')->check()) {
            if ($pembayaran->tagihan->id_pelanggan !== auth()->guard('pelanggan')->id()) {
                abort(403, 'Unauthorized');
            }
        }

        $pembayaran->load(['tagihan.pelanggan.tarif', 'tagihan.penggunaan', 'user']);
        return view('pembayarans.show', compact('pembayaran'));
    }

    public function edit(Pembayaran $pembayaran)
    {
        // Pembayaran tidak bisa diedit
        return redirect()->route('pembayarans.index')->with('error', 'Pembayaran tidak bisa diedit.');
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        // Pembayaran tidak bisa diupdate
        return redirect()->route('pembayarans.index')->with('error', 'Pembayaran tidak bisa diupdate.');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        // Pembayaran tidak bisa dihapus (untuk audit trail)
        return redirect()->route('pembayarans.index')->with('error', 'Pembayaran tidak bisa dihapus untuk alasan audit.');
    }
}
