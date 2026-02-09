<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Penggunaan - Data penggunaan listrik pelanggan
 *
 * Model ini merepresentasikan data penggunaan listrik bulanan untuk setiap pelanggan.
 * Data penggunaan mencatat meter awal (dari bulan sebelumnya) dan meter akhir,
 * kemudian digunakan untuk menghitung jumlah meter yang digunakan.
 *
 * @property int $id_penggunaan Primary key untuk penggunaan
 * @property int $id_pelanggan Foreign key ke tabel pelanggan
 * @property string $bulan Bulan penggunaan (1-12)
 * @property int $tahun Tahun penggunaan
 * @property float $meter_awal Meter awal (diambil dari meter_ahir bulan sebelumnya)
 * @property float $meter_ahir Meter akhir pada akhir bulan
 * @property \Carbon\Carbon $created_at Timestamp pembuatan
 * @property \Carbon\Carbon $updated_at Timestamp update terakhir
 *
 * @property-read \App\Models\Pelanggan $pelanggan Relasi ke data pelanggan
 * @property-read \App\Models\Tagihan|null $tagihan Relasi ke data tagihan (dibuat otomatis)
 */
class Penggunaan extends Model
{
    use HasFactory;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_penggunaan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_pelanggan', 'bulan', 'tahun', 'meter_awal', 'meter_ahir'];

    /**
     * Relasi ke model Pelanggan
     *
     * Setiap data penggunaan dimiliki oleh satu pelanggan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    /**
     * Relasi ke model Tagihan
     *
     * Setiap penggunaan dapat memiliki satu tagihan (dibuat otomatis)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tagihan()
    {
        return $this->hasOne(Tagihan::class, 'id_penggunaan', 'id_penggunaan');
    }
}
