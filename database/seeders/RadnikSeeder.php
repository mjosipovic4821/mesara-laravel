<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Radnik;

class RadnikSeeder extends Seeder
{
    public function run(): void
    {
        Radnik::factory()->count(6)->create();
    }
}
