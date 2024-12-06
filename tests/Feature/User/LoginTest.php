<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        
    // login test
        $response = $this->post( '/api/login' ,
    [
        'email' => 'bsardroodi@gmail.com' ,
        'password' => 'bardia1382'
    ]);
        $response->assertStatus(200);
    }
}
