<?php

namespace Database\Factories;

use App\Enums\Categories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            'money' => mt_rand(1000, 5000),
            'name' => fake()->name,
            'created_at' => now(),
            'user_id' => $user->id,
        ];
    }
}
