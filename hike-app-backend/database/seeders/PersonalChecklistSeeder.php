<?php

namespace Database\Seeders;

use App\Models\PersonalChecklist;
use Illuminate\Database\Seeder;

class PersonalChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PersonalChecklist::factory(20)->create();
    }
}
