<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        for ($i = 1; $i <= 10; $i++) { 
            $user = User::create([
                'name' => 'User' . $i,
                'email' => 'email' . $i . '@gmail.com',
                'password' => Hash::make('qwerty'),
            ]);
        }
    }
}
