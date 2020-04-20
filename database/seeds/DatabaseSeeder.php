<?php

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
         $this->call(UserTypesSeeder::class);
         $this->call(StartupTypesSeeder::class);
         $this->call(IndustrySeeder::class);
//         $this->call(CountrySeeder::class);
    }
}
