<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_log_in_successfully()
    {
        // 1. Create a user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);
        $response->assertRedirect('/dashboard'); 
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_login_fails_with_wrong_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword'
        ]);
        $response->assertSessionHasErrors(); 
        $this->assertGuest();
    }
}
