<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif', 'id_tarif');
    }

    public function penggunaans()
    {
        return $this->hasMany(Penggunaan::class, 'id_pelanggan', 'id_pelanggan');
    }

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
