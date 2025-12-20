<?php

namespace Database\Factories;

use App\Models\Materijal;
use App\Models\Nabavka;
use App\Models\NabavkaMaterijal;
use Illuminate\Database\Eloquent\Factories\Factory;

class StavkaNabavkeFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nabavka_id' => Nabavka::factory(),
            'materijal_id' => Materijal::factory(),
            'kolicina' => fake()->randomFloat(3, 0, 999999999.999),
            'cena_po_jedinici' => fake()->randomFloat(2, 0, 9999999999.99),
            'iznos' => fake()->randomFloat(2, 0, 9999999999.99),
            'nabavka_materijal_id' => NabavkaMaterijal::factory(),
        ];
    }
}
