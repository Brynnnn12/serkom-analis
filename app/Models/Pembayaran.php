<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Pembayaran - Data pembayaran tagihan listrik
 *
 * Model ini merepresentasikan data pembayaran yang dilakukan oleh pelanggan untuk tagihan listrik.
 * Pembayaran mencatat detail transaksi termasuk biaya admin, total bayar, uang dibayar, dan kembalian.
 * Data pembayaran tidak dapat diubah atau dihapus untuk alasan audit trail.
 *
 * @property int $id_pembayaran Primary key untuk pembayaran
 * @property int $id_tagihan Foreign key ke tabel tagihan
 * @property int $id_pelanggan Foreign key ke tabel pelanggan
 * @property int $id_user Foreign key ke tabel user (admin yang memproses)
 * @property string $tanggal_pembayaran Tanggal pembayaran dilakukan
 * @property int $bulan_bayar Bulan pembayaran (1-12)
 * @property float $biaya_admin Biaya administrasi pembayaran
 * @property float $total_bayar Total yang harus dibayar (tagihan + biaya admin)
 * @property float $uang_dibayar Jumlah uang yang dibayar pelanggan
 * @property float $kembalian Kembalian yang diberikan (uang_dibayar - total_bayar)
 * @property \Carbon\Carbon $created_at Timestamp pembuatan
 * @property \Carbon\Carbon $updated_at Timestamp update terakhir
 *
 * @property-read \App\Models\Tagihan $tagihan Relasi ke data tagihan
 * @property-read \App\Models\User $user Relasi ke data admin yang memproses
 */
class Pembayaran extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = ['id_tagihan', 'id_pelanggan', 'id_user', 'tanggal_pembayaran', 'bulan_bayar', 'biaya_admin', 'total_bayar', 'uang_dibayar', 'kembalian'];

    /**
     * Relasi ke model Tagihan
     *
     * Setiap pembayaran terkait dengan satu tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id_tagihan');
    }

    /**
     * Relasi ke model User
     *
     * Setiap pembayaran diproses oleh satu admin/user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
