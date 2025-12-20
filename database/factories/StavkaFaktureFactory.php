<?php

namespace Database\Factories;

use App\Models\Faktura;
use App\Models\FakturaProizvod;
use App\Models\Proizvod;
use Illuminate\Database\Eloquent\Factories\Factory;

class StavkaFaktureFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'faktura_id' => Faktura::factory(),
            'proizvod_id' => Proizvod::factory(),
            'kolicina' => fake()->randomFloat(3, 0, 999999999.999),
            'cena' => fake()->randomFloat(2, 0, 9999999999.99),
            'iznos' => fake()->randomFloat(2, 0, 9999999999.99),
            'faktura_proizvod_id' => FakturaProizvod::factory(),
        ];
    }
}
