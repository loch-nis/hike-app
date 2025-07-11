<?php

namespace Database\Seeders;

use App\Models\HikeUser;
use Illuminate\Database\Seeder;

class HikeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HikeUser::factory(20)->create();
    }
}
