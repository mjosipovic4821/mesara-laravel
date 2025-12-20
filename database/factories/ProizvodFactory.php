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
        $nazivi = [
            'Juneće mleveno meso',
            'Svinjski vrat',
            'Pileći file',
            'Kobasica domaća',
            'Ćevapi sveži',
            'Pljeskavica',
            'Slanina dimljena',
            'Suva pečenica',
            'Junetina za supu',
            'Svinjska rebra',
        ];
        $suffix = $this->faker->unique()->numberBetween(1, 10000);

        return [
            'naziv_proizvoda' => $this->faker->randomElement($nazivi)." #{$suffix}",
            'tip' => $this->faker->randomElement(['gotov', 'sirovina_prodajna']),
            'prodajna_cena' => $this->faker->randomFloat(2, 300, 3500),
            'zaliha' => $this->faker->randomFloat(3, 0, 200),
            'aktivan' => $this->faker->boolean(90),
        ];
    }
}
