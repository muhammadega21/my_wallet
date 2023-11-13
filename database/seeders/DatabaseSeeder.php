<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'id' => 1,
            'name' => 'Muhammad Ega Dermawan',
            'username' => 'ega',
            'email' => 'dermawane988@gmail.com',
            'phone' => '085763000486',
            'id_user' => '2108',
            'password' => bcrypt('password'),
            'level' => '1',
        ]);

        Wallet::create([
            'user_id' => 1,
            'money_total' => 0
        ]);
    }
}
