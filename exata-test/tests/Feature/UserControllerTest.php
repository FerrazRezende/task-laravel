<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_retorna_todos_usuarios_para_admin()
    {
        $admin = User::factory()->create(['admin' => true]);
        $users = User::factory(10)->create();

        $this->actingAs($admin);

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)->assertJsonCount(11);
    }

    public function test_index_nega_todos_usuarios_para_comum()
    {
        $user = User::factory()->create(['admin' => false]);

        $this->actingAs($user);

        $response = $this->getJson('/api/users');

        $response->assertStatus(403)->assertSee('Acesso negado!');
    }

    public function test_get_user_id_retorna_usuario_encontrado()
    {
        $admin = User::factory()->create(['admin' => true]);

        $this->actingAs($admin);

        $user = User::factory()->create();

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertStatus(200)->assertJson(['id' => $user->id]);
    }

    public function test_se_get_user_id_retorna_204_caso_nao_encontrado()
    {
        $admin = User::factory()->create(['admin' => true]);

        $this->actingAs($admin);

        $response = $this->getJson('/api/users/999');

        $response->assertStatus(204);
    }

    public function test_update_user_com_dados_validos()
    {

        $admin = User::factory()->create(['admin' => true]);

        $this->actingAs($admin);

        $user = User::factory()->create();
        $data = [
            'nome' => 'Nome Atualizado',
            'password' => 'SenhaNova123',
        ];

        $response = $this->putJson("/api/users/{$user->id}", $data);

        $response->assertStatus(200)->assertJson(['nome' => 'Nome Atualizado']);
    }

    public function test_update_retorna_204_caso_usuario_nao_encontrado()
    {
        $admin = User::factory()->create(['admin' => true]);

        $this->actingAs($admin);

        $data = [
            'nome' => 'Nome Qualquer',
            'password' => 'SenhaNova123',
        ];

        $response = $this->putJson('/api/users/999', $data);

        $response->assertStatus(204);
    }

    public function test_delete_user_caso_admin()
    {
        $admin = User::factory()->create(['admin' => true]);
        $user = User::factory()->create();

        $this->actingAs($admin);

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(200)->assertJson(['message' => 'Usuário deletado com sucesso!']);
    }

    public function test_delete_retorna_204_caso_nao_encontrado()
    {
        $admin = User::factory()->create(['admin' => true]);

        $this->actingAs($admin);

        $response = $this->deleteJson('/api/users/999');

        $response->assertStatus(204);
    }

    public function test_delete_nega_acesso_para_usuario_comum()
    {
        $user = User::factory()->create(['admin' => false]);
        $targetUser = User::factory()->create();

        $this->actingAs($user);

        $response = $this->deleteJson("/api/users/{$targetUser->id}");

        $response->assertStatus(403)
            ->assertSee('Acesso negado!');
    }


}
