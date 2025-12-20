<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dobavljac;

class DobavljacSeeder extends Seeder
{
    public function run(): void
    {
        Dobavljac::factory()->count(10)->create();
    }
}
