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
        $email = env('ADMIN_SEED_EMAIL');
        $password = env('ADMIN_SEED_PASSWORD');

        if (!$email || !$password) {
            $this->command?->warn('Skipping admin user seeding: set ADMIN_SEED_EMAIL and ADMIN_SEED_PASSWORD to provision an initial admin.');

            return;
        }

        DB::table('users')->updateOrInsert(['email' => $email], [
            'first_name' => env('ADMIN_SEED_FIRST_NAME', 'System'),
            'last_name' => env('ADMIN_SEED_LAST_NAME', 'Administrator'),
            'username' => env('ADMIN_SEED_USERNAME', 'admin'),
            'phone' => env('ADMIN_SEED_PHONE', '+260000000000'),
            'address' => env('ADMIN_SEED_ADDRESS', 'Configure this address'),
            'date_of_birth' => env('ADMIN_SEED_DATE_OF_BIRTH', '1990-01-01'),
            'gender' => 'MALE',
            'role' => 'ADMIN',
            'status' => 'ACTIVE',
            'profile_picture' => null,
            'locked_at' => null,
            'attempts' => 0,
            'email_verified_at' => now(),
            'password' => Hash::make($password),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
