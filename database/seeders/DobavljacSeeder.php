<?php

namespace Database\Seeders;

use App\Models\Dobavljac;
use Illuminate\Database\Seeder;

class DobavljacSeeder extends Seeder
{
    public function run(): void
    {
        Dobavljac::factory()->count(10)->create();
    }
}
