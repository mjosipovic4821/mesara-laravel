<?php

namespace Database\Factories;

use App\Models\Kupac;
use App\Models\KupacRadnik;
use App\Models\Radnik;
use Illuminate\Database\Eloquent\Factories\Factory;

class FakturaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'kupac_id' => Kupac::factory(),
            'radnik_id' => Radnik::factory(),
            'datum' => fake()->date(),
            'napomena' => fake()->text(),
            'ukupno' => fake()->randomFloat(2, 0, 9999999999.99),
            'kupac_radnik_id' => KupacRadnik::factory(),
        ];
    }
}
