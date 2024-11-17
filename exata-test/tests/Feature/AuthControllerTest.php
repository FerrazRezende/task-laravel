<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;


    /** @test */
    public function a_user_can_register(): void
    {
        $response = $this->postJson('/api/register', [
            'nome' => $this->faker->name(),
            'nome_usuario' => $this->faker->userName(),
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'admin' => false
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseCount('users', 1);
    }

    /** @test */
    public function a_user_cannot_register_with_invalid_data()
    {
        $response = $this->postJson('/api/register', [
            'nome' => '',
            'nome_usuario' => '',
            'password' => '123',
            'password_confirmation' => '456',
            'admin' => true
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function a_user_can_login()
    {
        $user = User::factory()->create([
            'nome_usuario' => 'testuser',
            'password' => Hash::Make('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'nome_usuario' => 'testuser',
            'password' => 'password123',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'user_id',
            'is_admin',
        ]);
    }

    /** @test */
    public function a_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->postJson('/api/login', [
            'nome_usuario' => 'nonexistentuser',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Credenciais inválidas']);
    }
}
