<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use App\Models\Penggunaan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penggunaan>
 */
class PenggunaanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Penggunaan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_pelanggan' => Pelanggan::factory(),
            'bulan' => $this->faker->numberBetween(1, 12),
            'tahun' => $this->faker->year(),
            'meter_awal' => 100,
            'meter_ahir' => 150,
        ];
    }
}
