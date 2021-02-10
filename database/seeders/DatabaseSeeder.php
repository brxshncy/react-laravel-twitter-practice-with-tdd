<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFollowingUserFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        User::create([
            'name' => 'Admin Bruce',
            'email' => 'bruce@test.com',
            'password' => bcrypt('test123')
        ]);
        $this->call(Userseeder::class);
        $this->call(UserFollowingUserSeeder::class);
    }
}
