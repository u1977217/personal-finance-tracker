<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Saver;

class SaverSeeder extends Seeder
{
    public function run()
    {
        $savers = [
            ['name' => 'J.K. Rowling', 'biography' => 'Author of Harry Potter series.'],
            ['name' => 'George R.R. Martin', 'biography' => 'Author of A Song of Ice and Fire.'],
        ];

        $users = [1, 2];

        foreach ($users as $user_id) {
            foreach ($savers as $saver) {
                Saver::create(array_merge($saver, ['user_id' => $user_id]));
            }
        }
    }
}
