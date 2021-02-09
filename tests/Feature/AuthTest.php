<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use WithFaker;
    


    public function test_if_user_can_register()
    {
        $this->withoutExceptionHandling();
        $payload = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password
        ];

        $response = $this->postJson(route('register'), $payload);
        
      

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => ['user']
                ]);
    }

    public function test_if_user_can_login()
    {

        $this->withoutExceptionHandling();
        $payload = [
            'email' => 'bruce@test.com',
            'password' => 'test123'
        ];
       

        $response = $this->postJson(route('login'), $payload);

    

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => ['token']
                 ]);
    }
}
