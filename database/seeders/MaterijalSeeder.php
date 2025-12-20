<?php

namespace Database\Seeders;

use App\Models\Materijal;
use Illuminate\Database\Seeder;

class MaterijalSeeder extends Seeder
{
    public function run(): void
    {
        Materijal::factory()->count(12)->create();
    }
}
