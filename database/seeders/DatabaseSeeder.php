<?php

namespace Database\Seeders;

use Guiliredu\BrazilianCityMigrationSeed\Database\Seeds\CityTableSeeder;
use Guiliredu\BrazilianCityMigrationSeed\Database\Seeds\StateTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StateTableSeeder::class,
            CityTableSeeder::class,
        ]);
    }
}
