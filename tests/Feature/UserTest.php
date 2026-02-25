<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_registration(): void
    {

        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '0912345678',
            'gender' => 'male',
            'address' => '123 Main St',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
        ]);
    }

    public function test_user_login(): void
    {
        $user = \App\Models\User::factory()->create([
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
    }

    public function test_user_password_update(): void
    {
        $user = \App\Models\User::factory()->create();

        // ၂။ အဆိုပါ User အနေဖြင့် Login ဝင်ထားကြောင်း သတ်မှတ်ပေးပါ
        $this->actingAs($user);
        $response = $this->post(route('changePage#password'), [
            'oldPassword' => 'password',
            'newPassword' => 'new-password',
            'comfirmPassword' => 'new-password',
        ]);

        $response->assertStatus(302);
        $this->assertGuest();
        $response->assertRedirect(route('login#page'));
        
    }
}
