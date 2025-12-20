<?php

namespace Database\Seeders;

use App\Models\Kupac;
use Illuminate\Database\Seeder;

class KupacSeeder extends Seeder
{
    public function run(): void
    {
        Kupac::factory()->count(10)->create();
    }
}
