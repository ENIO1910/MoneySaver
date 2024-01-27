<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'test',
             'email' => 'test@test.com.pl',
             'password' => Hash::make('asdasd')
         ]);
        \App\Models\Wallet::factory(1)->create();

         \App\Models\Expense::factory(10)->create();

    }
}
