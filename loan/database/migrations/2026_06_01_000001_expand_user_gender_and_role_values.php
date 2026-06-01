<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_gender_check');
            DB::statement("ALTER TABLE users ADD CONSTRAINT users_gender_check CHECK (gender IN ('MALE', 'FEMALE', 'OTHER'))");
            DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check');
            DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('USER', 'ADMIN', 'MANAGER'))");
        }

        if (in_array(DB::getDriverName(), ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE users MODIFY gender ENUM('MALE', 'FEMALE', 'OTHER') NULL");
            DB::statement("ALTER TABLE users MODIFY role ENUM('USER', 'ADMIN', 'MANAGER') NOT NULL DEFAULT 'USER'");
        }
    }

    public function down(): void
    {
        DB::table('users')->where('gender', 'OTHER')->update(['gender' => null]);
        DB::table('users')->where('role', 'MANAGER')->update(['role' => 'USER']);

        if (DB::getDriverName() === 'pgsql') {
            DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_gender_check');
            DB::statement("ALTER TABLE users ADD CONSTRAINT users_gender_check CHECK (gender IN ('MALE', 'FEMALE'))");
            DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check');
            DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('USER', 'ADMIN'))");
        }

        if (in_array(DB::getDriverName(), ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE users MODIFY gender ENUM('MALE', 'FEMALE') NULL");
            DB::statement("ALTER TABLE users MODIFY role ENUM('USER', 'ADMIN') NOT NULL DEFAULT 'USER'");
        }
    }
};
