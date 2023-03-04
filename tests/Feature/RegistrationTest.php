<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register()
    {
        $response = $this->post('/api/register', [
            'username' => 'Test User',
            'email' => 'buri@bestcolombian.com',
            'password' => '12345678',
            'phone' => '123456789'
        ]);
 
        $response->assertStatus(200);
    }

}
