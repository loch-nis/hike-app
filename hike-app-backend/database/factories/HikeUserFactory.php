<?php

namespace Database\Factories;

use App\Models\Hike;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HikeUser>
 */
class HikeUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hike_id' => Hike::factory(),
            'user_id' => User::factory(),
            'role' => fake()->randomElement(['owner', 'participant']),
            'joined_at' => now(),
        ];
    }
}
