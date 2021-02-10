<?php

namespace Tests\Feature;

use App\Models\Following;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserCanFollowTest extends TestCase
{
   public function test_if_user_can_follow_other_user()
   {

       $this->withoutExceptionHandling();

       $user =  User::inRandomOrder()->first();
       $following = Following::inRandomOrder()->first();

       Passport::actingAs((
            $user
       ));

      
       $payload = [
           'user_id' => $user->id,
           'following_id' => $following->id
       ];

       $response = $this->postJson(route('follow.user') ,$payload);

       
       $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => ['followed']
                ]);
       
   }

   public function test_if_user_can_unfollow_user ()
   {
        $this->withoutExceptionHandling();
        $user = User::inRandomOrder()->first();
        
        Passport::actingAs(($user));
        $response = $this->getJson(route('unfollow.user', $user->id));

        $response->assertStatus(200);

   }
}
