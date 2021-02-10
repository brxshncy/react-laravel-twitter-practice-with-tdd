<?php

namespace Database\Seeders;

use App\Models\Following;
use Illuminate\Database\Seeder;

class UserFollowingUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Following::factory()
                 ->count(20)
                 ->create();
    }
}
