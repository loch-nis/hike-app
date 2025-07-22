<?php

namespace Database\Factories;

use App\Models\PersonalChecklist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalChecklistItem>
 */
class PersonalChecklistItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'checklist_id' => PersonalChecklist::factory(),
            'is_checked' => fake()->boolean(30),
            'checked_at' => fake()->randomElement([null, now()]),
            'content' => fake()->randomElement([
                "🎒 Backpack", "💧 Water bottle", "🗺️ Map", "🧭 Compass", "📡 GPS device", "🥨 Snacks", "🥜 Trail mix",
                "🍫 Energy bars", "🥪 Sandwich", "🛠️ Multi-tool", "🩹 First aid kit", "🌧️ Rain jacket", "🧴 Sunscreen",
                "🕶️ Sunglasses", "🧢 Hat", "🔦 Headlamp", "🔦 Flashlight", "🔋 Extra batteries", "🔌 Portable charger",
                "📱 Phone", "📯 Whistle", "🦟 Insect repellent", "🥾 Trekking poles", "🧤 Gloves", "🧥 Warm layers",
                "🛏️ Sleeping bag", "⛺ Tent", "🪵 Sleeping pad", "🍽️ Lightweight cookware", "🍲 Dehydrated meals",
                "🧻 Toilet paper", "🧼 Hand sanitizer", "🗑️ Trash bag", "📷 Camera", "🔥 Firestarter",
                "🧽 Biodegradable soap", "🪥 Toothbrush & toothpaste", "👕 Extra clothes"
            ])
        ];
    }
}
