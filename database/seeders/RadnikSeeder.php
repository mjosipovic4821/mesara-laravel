<?php

namespace Database\Seeders;

use App\Models\Radnik;
use Illuminate\Database\Seeder;

class RadnikSeeder extends Seeder
{
    public function run(): void
    {
        Radnik::factory()->count(6)->create();
    }
}
