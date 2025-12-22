<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DobavljacSeeder::class,
            MaterijalSeeder::class,
            ProizvodSeeder::class,
            KupacSeeder::class,
            RadnikSeeder::class,
        ]);
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@mesara.test'],
            [
                'name' => 'Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('Password123!'),
            ]
        );

    }
}
