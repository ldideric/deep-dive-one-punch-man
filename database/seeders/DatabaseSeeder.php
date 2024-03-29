<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AttackTypeSeeder::class,
            AdminSeeder::class,
            // UserSeeder::class,
            // BattleSeeder::class,
        ]);
    }
}
