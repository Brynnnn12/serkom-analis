<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LevelSeeder::class);

        // Buat admin
        User::create([
            'id_level' => 1,
            'nama_admin' => 'Admin Utama',
            'username' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // Buat tarif dulu
        $tarif = Tarif::firstOrCreate([
            'daya' => '1300',
            'tarifperkwh' => 1500,
        ]);

        // Buat pelanggan untuk testing
        Pelanggan::create([
            'username' => 'pelanggan',
            'password' => bcrypt('password'),
            'nomor_kwh' => '1234567890',
            'nama_pelanggan' => 'Pelanggan Test',
            'alamat' => 'Jl. Test No. 123',
            'id_tarif' => $tarif->id_tarif,
        ]);
    }
}
