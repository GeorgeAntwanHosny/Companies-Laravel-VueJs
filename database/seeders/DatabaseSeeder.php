<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Provider\ar_EG\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(10)->create();

         \App\Models\User::factory(10)->create([

             'password' => bcrypt('password'),
         ]);
        \App\Models\Company::factory(20)->create();
    }
}
