<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'username' => 'admin',
                'password' => 'admin',
                'nama' => 'Admin',
                'level' => 'admin'
            ],
            [
                'username' => 'dhani',
                'password' => '1234',
                'nama' => 'Ahmad Dhani Prasetya',
                'level' => 'siswa'
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
