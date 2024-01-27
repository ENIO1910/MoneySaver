<?php

namespace Database\Factories;

use App\Enums\Categories;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::find(1);
        $wallet = Wallet::factory()->create([
            'user_id' => $user->id,
        ]);
        return [
            'money' => mt_rand(10, 500),
            'category' => Categories::GROCERIES->value,
            'created_at' => now(),
            'user_id' => $user->id,
            'wallet_id' => $wallet->id,
        ];
    }
}
