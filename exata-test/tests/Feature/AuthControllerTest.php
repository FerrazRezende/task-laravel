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
    public function test_se_usuario_pode_registrar(): void
    {
        $response = $this->postJson('/api/register', [
            'nome' => $this->faker->name(),
            'nome_usuario' => $this->faker->userName(),
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
            'admin' => false
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseCount('users', 1);
    }

    /** @test */
    public function test_se_usuario_nao_pode_registrar_com_dados_invalidos()
    {
        $response = $this->postJson('/api/register', [
            'nome' => ' ',
            'nome_usuario' => ' ',
            'password' => '12345678M',
            'password_confirmation' => '12345678M',
            'admin' => true
        ]);

        $response->assertStatus(422);
    }

    public function test_se_usuario_nao_pode_registrar_com_senha_fora_padrao()
    {
        $response = $this->postJson('/api/register', [
            'nome' => 'Matheus',
            'nome_usuario' => 'mtsferraz',
            'password' => 'senha12345',
            'password_confirmation' => 'senha12345',
            'admin' => true
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function test_se_usuario_pode_logar()
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
    public function test_se_usuario_forneceu_credenciais_invalidas()
    {
        $response = $this->postJson('/api/login', [
            'nome_usuario' => 'nonexistentuser',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Credenciais inválidas']);
    }
}
