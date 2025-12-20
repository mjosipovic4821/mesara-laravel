<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KupacFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'naziv_kupca' => fake()->regexify('[A-Za-z0-9]{120}'),
            'telefon' => fake()->regexify('[A-Za-z0-9]{30}'),
            'email' => fake()->safeEmail(),
            'adresa' => fake()->regexify('[A-Za-z0-9]{160}'),
            'grad' => fake()->regexify('[A-Za-z0-9]{80}'),
            'pib' => fake()->regexify('[A-Za-z0-9]{20}'),
        ];
    }
}
