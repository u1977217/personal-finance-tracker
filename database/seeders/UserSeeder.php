<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // role_id: 1 = normal user, 2 = admin
        DB::table('users')->insert([
            'name'     => 'Normal User',
            'email'    => 'normal@example.com',
            'password' => Hash::make('normal123'),
            'role_id'  => 1,
        ]);

        DB::table('users')->insert([
            'name'     => 'Admin User',
            'email'    => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role_id'  => 2,
        ]);
    }
}
