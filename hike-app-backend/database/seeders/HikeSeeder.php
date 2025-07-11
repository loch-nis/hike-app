<?php

namespace Database\Seeders;

use App\Models\Hike;
use Illuminate\Database\Seeder;

class HikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Hike::factory(5)->create();


    }
}
