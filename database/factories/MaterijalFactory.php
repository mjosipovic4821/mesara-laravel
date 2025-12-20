<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MaterijalFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'naziv' => fake()->regexify('[A-Za-z0-9]{120}'),
            'jedinica_mere' => fake()->regexify('[A-Za-z0-9]{12}'),
            'zaliha' => fake()->randomFloat(3, 0, 999999999.999),
            'referentna_cena' => fake()->randomFloat(2, 0, 9999999999.99),
        ];
    }
}
