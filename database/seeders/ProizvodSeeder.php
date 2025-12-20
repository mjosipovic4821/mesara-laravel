<?php

namespace Database\Seeders;

use App\Models\Proizvod;
use Illuminate\Database\Seeder;

class ProizvodSeeder extends Seeder
{
    public function run(): void
    {
        Proizvod::factory()->count(15)->create();
    }
}
