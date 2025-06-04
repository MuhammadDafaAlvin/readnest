<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin@example.com'),
                'role_id' => 3,
            ],
            [
                'name' => 'Writer User',
                'email' => 'writer@example.com',
                'password' => Hash::make('writer@example.com'),
                'role_id' => 2,
            ],
            [
                'name' => 'Reader User',
                'email' => 'reader@example.com',
                'password' => Hash::make('reader@example.com'),
                'role_id' => 1,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
