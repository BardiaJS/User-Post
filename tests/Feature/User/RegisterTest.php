<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */

     //register test
    public function test_register(): void
    {
        $response = $this->post('/api/register' , ['first_name' => 'Bardia' , 'last_name' => 'Jahanbini' , 'display_name' => 'BardiaJhs' , 'email' => 'bsardroodi@gmail.com' , 'password' => 'bardia1382' , 'password_confirmation' => 'bardia1382']);
        $response->assertStatus(201);
        // User::where('email' , 'bsardroodi@gmail.com')->delete();
    }


    //login test


}
