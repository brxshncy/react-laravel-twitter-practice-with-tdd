<?php

namespace Tests\Feature;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserTweetTest extends TestCase
{
    use WithFaker;
   

    public function test_if_user_can_view_tweets_to_its_feed()
    {
        $this->withoutExceptionHandling();
        
        Passport::actingAs((
            User::factory()->create()
        ));

        $response = $this->getJson( route('index.tweet') );

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => ['tweets']
                 ]);
    }

    public function test_if_user_can_post_tweet()
    {
        $this->withoutExceptionHandling();

        Passport::actingAs((
            User::factory()->create()
        ));

        $payload = [
            'tweet' => $this->faker->sentence($nbWords = 6, $variableNbWords = true)
        ];
        $response = $this->postJson( route('post.tweet'), $payload);

        $response->assertJsonStructure([
            'data' => ['tweet']
        ]);

    }

    public function test_if_user_can_view_specific_tweet()
    {
        $this->withoutExceptionHandling();

        Passport::actingAs((
            User::factory()->create()
        ));
        $tweet = Tweet::inRandomOrder()->first();

        $response = $this->getJson( route('show.tweet', $tweet->id));

      
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => ['tweet']
                 ]);
    }

    public function test_if_user_can_update_tweet()
    {
        $this->withoutExceptionHandling();

        Passport::actingAs((
            User::factory()->create()
        ));

        $payload = [
            'tweet' => $this->faker->sentence($nbWords = 6, $variableNbWords = true)
        ];
        
        $tweet = Tweet::inRandomOrder()->first();
      
        $response = $this->putJson( route('update.tweet', $tweet->id), $payload );

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => ['tweet']
                 ]);
    }

    public function test_if_user_can_delete_their_own_tweet () {

        $this->withoutExceptionHandling();

        $user = User::inRandomOrder()->first();

        Passport::actingAs($user);

     
        $tweet = Tweet::first();

     
        $response = $this->deleteJson( route('destroy.tweet', $tweet->id));

        
        $response->assertStatus(200);

    }

}
