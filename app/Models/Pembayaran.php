<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_pembayaran
 * @property int $id_tagihan
 * @property int $id_pelanggan
 * @property int $id_user
 * @property string $tanggal_pembayaran
 * @property int $bulan_bayar
 * @property float $biaya_admin
 * @property float $total_bayar
 * @property float $uang_dibayar
 * @property float $kembalian
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Pembayaran extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = ['id_tagihan', 'id_pelanggan', 'id_user', 'tanggal_pembayaran', 'bulan_bayar', 'biaya_admin', 'total_bayar', 'uang_dibayar', 'kembalian'];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id_tagihan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
