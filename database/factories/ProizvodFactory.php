<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProizvodFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'naziv_proizvoda' => fake()->regexify('[A-Za-z0-9]{120}'),
            'tip' => fake()->regexify('[A-Za-z0-9]{30}'),
            'prodajna_cena' => fake()->randomFloat(2, 0, 9999999999.99),
            'zaliha' => fake()->randomFloat(3, 0, 999999999.999),
            'aktivan' => fake()->boolean(),
        ];
    }
}
