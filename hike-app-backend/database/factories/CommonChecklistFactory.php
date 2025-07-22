<?php

namespace Database\Factories;

use App\Models\Hike;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommonChecklistFactory extends Factory
{
    public function definition(): array
    {
        return [
            'hike_id' => Hike::factory(),
        ];
    }
}
