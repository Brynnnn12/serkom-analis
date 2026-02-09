<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_tagihan
 * @property int $id_penggunaan
 * @property int $id_pelanggan
 * @property string $bulan
 * @property int $tahun
 * @property int $jumlah_meter
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Tagihan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tagihan';

    protected $fillable = ['id_penggunaan', 'id_pelanggan', 'bulan', 'tahun', 'jumlah_meter', 'status'];

    public function penggunaan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_penggunaan', 'id_penggunaan');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_tagihan', 'id_tagihan');
    }
}
