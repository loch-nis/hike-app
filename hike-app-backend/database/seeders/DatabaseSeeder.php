<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        $this->call(HikeTestSeeder::class);

        // todo this is probably not good, since a HikeUser isn't guaranteed to have a personalChecklist, right ?!
        $this->call(UserSeeder::class);
        $this->call(HikeSeeder::class);
        $this->call(HikeUserSeeder::class);
        $this->call(PersonalChecklistSeeder::class);
        $this->call(PersonalChecklistItemSeeder::class);
    }
}
