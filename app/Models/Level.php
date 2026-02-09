<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Level - Data level akses admin/user
 *
 * Model ini merepresentasikan level akses yang dimiliki oleh admin/user sistem.
 * Level menentukan hak akses dan permission yang dimiliki user dalam sistem PLN.
 *
 * @property int $id_level Primary key untuk level
 * @property string $nama_level Nama level akses (contoh: "Admin", "Operator", "Manager")
 * @property \Carbon\Carbon $created_at Timestamp pembuatan
 * @property \Carbon\Carbon $updated_at Timestamp update terakhir
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users Relasi ke user yang memiliki level ini
 */
class Level extends Model
{
    protected $primaryKey = 'id_level';

    protected $fillable = ['nama_level'];

    /**
     * Relasi ke model User
     *
     * Satu level dapat dimiliki oleh banyak user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'id_level', 'id_level');
    }
}
