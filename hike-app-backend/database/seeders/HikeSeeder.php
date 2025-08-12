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

class HikeSeeder extends Seeder
{
    public function run(): void
    {
        // todo investigate seeder naming and best practice types
        $hike = Hike::factory()
            ->has(HikeUser::factory()
                ->for(User::factory()->state(['email' => 'es@cia.gov'])))
            ->has(HikeUser::factory()
                ->for((User::factory()->state(['email' => 'jon@stark.com']))))
            ->create();

        $commonChecklist = CommonChecklist::factory()
            ->for($hike)
            ->create();

        CommonChecklistItem::factory()
            ->for($commonChecklist)
            ->count(10)
            ->create();

        $hikeUsers = $hike->hikeUsers;

        foreach ($hikeUsers as $hikeUser) {
            $personalChecklist = PersonalChecklist::factory()
                ->for($hikeUser)
                ->create();

            PersonalChecklistItem::factory()
                ->for($personalChecklist)
                ->count(20)
                ->create();
        }


    }
}
