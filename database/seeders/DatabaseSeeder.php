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
            UserSeeder::class, // Added this line
            AuthorSeeder::class,
            GenreSeeder::class,
            StatusSeeder::class,
            BookSeeder::class,
        ]);
    }
}
