<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materijal;

class MaterijalSeeder extends Seeder
{
    public function run(): void
    {
        Materijal::factory()->count(12)->create();
    }
}
