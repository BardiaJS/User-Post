<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_update(): void
    {

        $response = $this->put('/api/users/' , ['first_name '=> 'Jaber' , 'last_name' => 'Fathollah' , 'display_name' => 'JB' , 'email' => 'jsardroodi@gmail.com']);
        $response->assertStatus(201);
    }
}
