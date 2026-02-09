<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::create([
            'nama_level' => 'Administrator',
        ]);

        // Level 'Pelanggan' dihapus karena pelanggan login menggunakan tabel pelanggans,
        // bukan tabel users dengan level
        // Level::create([
        //     'nama_level' => 'Pelanggan',
        // ]);
    }
}
