<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Saver;
use App\Models\Genre;
use App\Models\Status;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Retrieve all existing savers, genres, and statuses
        $savers = Saver::all();
        $genres = Genre::all();
        $statuses = Status::all();

        // Initialize Faker
        $faker = Faker::create();

        // We'll build up an array of book data
        $bookData = [];

        // Generate 20 random entries
        for ($i = 0; $i < 20; $i++) {
            $saver  = $savers->random();
            $genre  = $genres->random();
            $status = $statuses->random();

            $bookData[] = [
                'title'       => $faker->sentence(4),
                'year'        => $faker->numberBetween(1900, 2023),
                'description' => $faker->paragraph(3),
                'status_id'   => $status->id,
                'pages'       => $faker->numberBetween(100, 1000),
                'saver_id'    => $saver->id,
                'genre_id'    => $genre->id,
                'user_id'     => $saver->user_id,
                'created_at'  => Carbon::now()->subDays(rand(1, 1000)),
                'updated_at'  => Carbon::now(),
            ];
        }

        DB::table('books')->insert($bookData);
    }
}
