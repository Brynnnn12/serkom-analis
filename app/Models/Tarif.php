<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model Tarif - Data tarif listrik berdasarkan daya
 *
 * Model ini merepresentasikan data tarif listrik per kWh berdasarkan daya listrik.
 * Setiap tarif memiliki daya tertentu (contoh: 900 VA, 1300 VA, 2200 VA) dengan
 * tarif per kWh yang berbeda-beda.
 *
 * @property int $id_tarif Primary key untuk tarif
 * @property string $daya Daya listrik (contoh: "900 VA", "1300 VA", "2200 VA")
 * @property float $tarifperkwh Tarif per kWh dalam rupiah
 * @property \Carbon\Carbon $created_at Timestamp pembuatan
 * @property \Carbon\Carbon $updated_at Timestamp update terakhir
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pelanggan> $pelanggans Relasi ke pelanggan yang menggunakan tarif ini
 */
class Tarif extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tarif';

    protected $fillable = ['daya', 'tarifperkwh'];

    /**
     * Relasi ke model Pelanggan
     *
     * Satu tarif dapat digunakan oleh banyak pelanggan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pelanggans()
    {
        return $this->hasMany(Pelanggan::class, 'id_tarif', 'id_tarif');
    }
}
