<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'SuperAdmin',
                'email' => 'test@email.com',
                'password' => Hash::make('password'),
                'type_user' => 0,
                'phone_number' => 123456789,
            ],
            [
                'name' => 'Testing',
                'email' => 'testing@email.com',
                'password' => Hash::make('password'),
                'type_user' => 1,
                'phone_number' => 123456789,
            ]
        ];

        foreach ($user as $users) {
            User::create($users);
        }
    }
}
