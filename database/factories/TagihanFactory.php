<?php

namespace Database\Factories;

use App\Models\Penggunaan;
use App\Models\Tagihan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tagihan>
 */
class TagihanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tagihan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_penggunaan' => Penggunaan::factory(),
            'bulan' => $this->faker->numberBetween(1, 12),
            'tahun' => $this->faker->year(),
            'jumlah_meter' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement(['Belum Bayar', 'Terbayar']),
        ];
    }
}
