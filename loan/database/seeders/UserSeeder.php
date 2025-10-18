<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Biness',
            'last_name' => 'Chama',
            'username' => 'chama',
            'phone' => '0965508033',
            'email' => 'binesschama1127@gmail.com',
            'address' => 'Basela, Kanyama',
            'date_of_birth' => '1995-05-20',
            'gender' => 'MALE',
            'role' => 'ADMIN',
            'status' => 'ACTIVE',
            'profile_picture' => null,
            'locked_at' => null,
            'attempts' => 0,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
