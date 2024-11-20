<?php

namespace Tests\Feature;

use App\Models\Tarefas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TarefasControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_criacao_tarefa()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $data = [
            'titulo' => 'Nova Tarefa',
            'descricao' => 'Descrição da tarefa',
            'status' => 'Pendente',
            'data_criacao' => now()->setTimezone('America/Sao_Paulo')->toDateTimeString(),
            'user_id' => $user->id,
        ];

        $response = $this->postJson('/api/tarefas', $data);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Tarefa salva com sucesso!',
            ]);
    }

    public function test_listagem_tarefas()
    {
        $admin = User::factory()->create(['admin' => true]);

        $this->actingAs($admin);

        Tarefas::factory()->count(3)->create();

        $response = $this->getJson('/api/tarefas');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_pegar_tarefa_id()
    {
        $tarefa = Tarefas::factory()->create();

        $admin = User::factory()->create(['admin' => true]);

        $this->actingAs($admin);

        $response = $this->getJson("/api/tarefas/{$tarefa->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $tarefa->id,
                'titulo' => $tarefa->titulo,
            ]);
    }

    public function test_atualizar_tarefa()
    {
        $admin = User::factory()->create(['admin' => true]);

        $this->actingAs($admin);

        $tarefa = Tarefas::factory()->create();

        $data = ['titulo' => 'Título atualizado'];

        $response = $this->putJson("/api/tarefas/{$tarefa->id}", $data);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Tarefa atualizada com sucesso!',
            ]);

        $this->assertDatabaseHas('tarefas', $data);
    }

    public function test_deletar_tarefa()
    {
        $admin = User::factory()->create(['admin' => true]);

        $this->actingAs($admin);

        $tarefa = Tarefas::factory()->create();

        $response = $this->deleteJson("/api/tarefas/{$tarefa->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Tarefa removida com sucesso!',
            ]);

        $this->assertDatabaseMissing('tarefas', ['id' => $tarefa->id]);
    }


}
