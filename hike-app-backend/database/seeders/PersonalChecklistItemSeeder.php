<?php

namespace Database\Seeders;

use App\Models\PersonalChecklistItem;
use Illuminate\Database\Seeder;

class PersonalChecklistItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonalChecklistItem::factory(500)->create();
    }
}
