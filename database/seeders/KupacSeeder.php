<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kupac;

class KupacSeeder extends Seeder
{
    public function run(): void
    {
        Kupac::factory()->count(10)->create();
    }
}
