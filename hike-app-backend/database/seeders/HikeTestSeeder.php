<?php

namespace Database\Seeders;

use App\Models\CommonChecklist;
use App\Models\CommonChecklistItem;
use App\Models\Hike;
use App\Models\HikeUser;
use App\Models\PersonalChecklist;
use App\Models\PersonalChecklistItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class HikeTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory()->count(3)->create();

        $hike = Hike::create([
            'title' => 'Efterårstur',
        ]);

        foreach ($users as $user) {
            $hikeUser = HikeUser::create([
                'hike_id' => $hike->id,
                'user_id' => $user->id,
                'role' => 'participant',
                'joined_at' => now(),
            ]);

            $personalChecklist = PersonalChecklist::create([
                'hike_user_id' => $hikeUser->id,
            ]);

            for ($i = 1; $i <= 3; $i++) {
                PersonalChecklistItem::create([
                    'checklist_id' => $personalChecklist->id,
                    'content' => "Personal item $i for {$user->first_name}",
                    'is_checked' => (bool) random_int(0, 1),
                    'checked_at' => now(),
                ]);
            }
        }

        $commonChecklist = CommonChecklist::create([
            'hike_id' => $hike->id,
        ]);

        foreach (range(1, 5) as $i) {
            CommonChecklistItem::create([
                'checklist_id' => $commonChecklist->id,
                'content' => "Shared item $i",
                'is_checked' => (bool) random_int(0, 1),
                'checked_by' => HikeUser::inRandomOrder()->first()->id,
                'checked_at' => now(),
            ]);
        }

    }
}
