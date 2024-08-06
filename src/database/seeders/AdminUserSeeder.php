<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone_number' => '1234567890',
            'password' => Hash::make('password'), // パスワードをハッシュ化
            'password_digest' => Hash::make('password'), // パスワードをハッシュ化
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}
