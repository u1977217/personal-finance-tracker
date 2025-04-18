<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run()
    {
        $genres = [
            ['name' => 'Fantasy', 'description' => 'Fantasy genre description.'],
            ['name' => 'Science Fiction', 'description' => 'Sci-Fi genre description.'],
        ];

        $users = [1, 2];

        foreach ($users as $user_id) {
            foreach ($genres as $genre) {
                Genre::create(array_merge($genre, ['user_id' => $user_id]));
            }
        }
    }
}
