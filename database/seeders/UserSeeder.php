<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Staff',
                'username' => 'staff1',
                'email' => 'staff@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'staff',
            ],
            [
                'name' => 'Siswa',
                'username' => 'siswa1',
                'email' => 'siswa@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'siswa',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
