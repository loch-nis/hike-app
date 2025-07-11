<?php

namespace Database\Factories;

use App\Models\CommonChecklist;
use App\Models\HikeUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommonChecklistItem>
 */
class CommonChecklistItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'checklist_id' => CommonChecklist::factory(),
            'is_checked' => fake()->boolean(),
            'checked_by' => HikeUser::factory(),
            'checked_at' => fake()->randomElement([null, now()]),
            'content' => fake()->randomElement([
                    "Backpack",
                    "Water bottle",
                    "Map",
                    "Compass",
                    "GPS device",
                    "Snacks",
                    "Trail mix",
                    "Energy bars",
                    "Sandwich",
                    "Multi-tool",
                    "First aid kit",
                    "Rain jacket",
                    "Sunscreen",
                    "Sunglasses",
                    "Hat",
                    "Headlamp",
                    "Flashlight",
                    "Extra batteries",
                    "Portable charger",
                    "Phone",
                    "Whistle",
                    "Insect repellent",
                    "Trekking poles",
                    "Gloves",
                    "Warm layers",
                    "Emergency blanket",
                    "Toilet paper",
                    "Hand sanitizer",
                    "Trash bag",
                    "Camera"
                ]
            )
        ];
    }
}
