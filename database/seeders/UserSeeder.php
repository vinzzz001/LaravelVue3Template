<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Generate an admin account for testing purposes.
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'first_name' => 'Vincent',
            'last_name' => '001',
            'email' => 'Vinzzz001@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'is_admin' => true,
            'telephone_number' => 1234567890,
            'remember_token' => '777',
        ]);
    }
}
