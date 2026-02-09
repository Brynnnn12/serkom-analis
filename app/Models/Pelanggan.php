<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model untuk tabel pelanggans
 *
 * Mewakili data pelanggan PLN yang dapat login ke sistem.
 * Menggunakan guard 'pelanggan' untuk autentikasi.
 *
 * @property int $id_pelanggan Primary key
 * @property string $username Username untuk login
 * @property string $password Password ter-hash
 * @property string $nama_pelanggan Nama lengkap pelanggan
 * @property string $nomor_kwh Nomor KWH meteran
 * @property string $alamat Alamat pelanggan
 * @property int $id_tarif Foreign key ke tabel tarifs
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property-read \App\Models\Tarif $tarif
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Penggunaan[] $penggunaans
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tagihan[] $tagihans
 */
class Pelanggan extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pelanggans';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_pelanggan';

    public function getAuthIdentifierName()
    {
        return 'id_pelanggan';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'nomor_kwh',
        'nama_pelanggan',
        'alamat',
        'id_tarif',
         'remember_token',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',

    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'id_tarif' => 'integer',
        ];
    }

    /**
     * Relasi ke model Tarif
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif', 'id_tarif');
    }

    /**
     * Relasi ke model Penggunaan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function penggunaans()
    {
        return $this->hasMany(Penggunaan::class, 'id_pelanggan', 'id_pelanggan');
    }

    /**
     * Relasi ke model Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'id_pelanggan', 'id_pelanggan');
    }

    /**
     * Get the unique identifier for the user.
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
}
