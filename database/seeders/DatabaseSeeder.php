<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $users = [
            [
                'name' => 'Yonggi Kawoco',
                'email' => 'jajiut@gmail.com',
                'password' => '12345678',
                'pass_hint' => Crypt::encrypt('12345678'),
                'role' => 'admin'
            ],
            [
                'name' => 'Jefri Holmes Mandey',
                'email' => 'jeje@gmail.com',
                'password' => '12345678',
                'pass_hint' => Crypt::encrypt('12345678'),
                'role' => 'admin'
            ]
        ];

        foreach($users as $user) {
             User::create($user);
        }
    }
}
