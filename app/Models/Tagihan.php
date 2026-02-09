<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Tagihan - Data tagihan listrik pelanggan
 *
 * Model ini merepresentasikan data tagihan listrik yang dihasilkan dari penggunaan listrik.
 * Tagihan dibuat otomatis ketika data penggunaan dicatat dan dapat memiliki status
 * 'Belum Bayar' atau 'Terbayar'.
 *
 * @property int $id_tagihan Primary key untuk tagihan
 * @property int $id_penggunaan Foreign key ke tabel penggunaan
 * @property int $id_pelanggan Foreign key ke tabel pelanggan
 * @property string $bulan Bulan tagihan (1-12)
 * @property int $tahun Tahun tagihan
 * @property int $jumlah_meter Jumlah meter yang digunakan
 * @property string $status Status pembayaran ('Belum Bayar' atau 'Terbayar')
 * @property \Carbon\Carbon $created_at Timestamp pembuatan
 * @property \Carbon\Carbon $updated_at Timestamp update terakhir
 *
 * @property-read \App\Models\Penggunaan $penggunaan Relasi ke data penggunaan
 * @property-read \App\Models\Pelanggan $pelanggan Relasi ke data pelanggan
 * @property-read \App\Models\Pembayaran|null $pembayaran Relasi ke data pembayaran (jika ada)
 */
class Tagihan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tagihan';

    protected $fillable = ['id_penggunaan', 'id_pelanggan', 'bulan', 'tahun', 'jumlah_meter', 'status'];

    /**
     * Relasi ke model Penggunaan
     *
     * Setiap tagihan berasal dari satu data penggunaan listrik
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penggunaan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_penggunaan', 'id_penggunaan');
    }

    /**
     * Relasi ke model Pelanggan
     *
     * Setiap tagihan dimiliki oleh satu pelanggan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    /**
     * Relasi ke model Pembayaran
     *
     * Tagihan dapat memiliki satu pembayaran (jika sudah dibayar)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_tagihan', 'id_tagihan');
    }
}
