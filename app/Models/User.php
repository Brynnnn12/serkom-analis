<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model User - Data admin/user sistem PLN
 *
 * Model ini merepresentasikan data admin/user yang dapat login ke sistem.
 * User memiliki level akses yang menentukan hak akses mereka dalam sistem.
 * Password di-hash menggunakan bcrypt untuk keamanan.
 *
 * @property int $id_user Primary key untuk user
 * @property string $username Username unik untuk login
 * @property string $password Password yang di-hash
 * @property string $nama_admin Nama lengkap admin
 * @property int $id_level Foreign key ke tabel level
 * @property string|null $remember_token Token untuk remember me functionality
 * @property \Carbon\Carbon $created_at Timestamp pembuatan
 * @property \Carbon\Carbon $updated_at Timestamp update terakhir
 *
 * @property-read \App\Models\Level $level Relasi ke data level akses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pembayaran> $pembayarans Relasi ke pembayaran yang diproses
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'password',
        'nama_admin',
        'id_level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected $primaryKey = 'id_user';

    /**
     * Relasi ke model Level
     *
     * Setiap user memiliki satu level akses
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level', 'id_level');
    }
}
