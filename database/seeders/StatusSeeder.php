<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run()
    {
        // Create basic statuses the user can use
        $statuses = [
            'To Read',
            'Reading',
            'Read',
        ];

        $users = [1, 2];

        foreach ($users as $user_id) {
            foreach ($statuses as $status) {
                Status::create([
                    'name'    => $status,
                    'user_id' => $user_id,
                ]);
            }
        }
    }
}
