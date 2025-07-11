<?php

namespace Database\Seeders;

use App\Models\HikeUser;
use App\Models\PersonalChecklist;
use App\Models\PersonalChecklistItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class HikeExampleSeeder extends Seeder
{
    public function run(): void
    {
        // todo investigate seeder naming and best practice types
        PersonalChecklistItem::factory()
            ->for(PersonalChecklist::factory()
                ->for(HikeUser::factory()
                    ->for(User::factory())), 'checklist')
            //omg this makes so much SENSE. calling the 'checklist' method on the PersonalChecklistItem model to get its checklistsssss. because non convention naming u know
            ->count(40)
            ->create();
    }
}
