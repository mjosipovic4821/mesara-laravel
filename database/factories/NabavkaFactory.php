<?php

namespace Database\Factories;

use App\Models\Dobavljac;
use Illuminate\Database\Eloquent\Factories\Factory;

class NabavkaFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'dobavljac_id' => Dobavljac::factory(),
            'datum_nabavke' => fake()->date(),
            'napomena' => fake()->text(),
            'ukupno' => fake()->randomFloat(2, 0, 9999999999.99),
        ];
    }
}
