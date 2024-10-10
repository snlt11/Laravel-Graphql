<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'admin',
            'email' => 'super@admin.com',
            'position' => 'Super Administrator',
            'salary' => '100000',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
        ]);
        User::factory(10000)->create();
    }
}
