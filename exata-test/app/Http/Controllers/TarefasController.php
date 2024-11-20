<?php

namespace App\Http\Controllers;

use App\Http\Requests\TarefasRequest;
use App\Models\Tarefas;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TarefasController extends Controller
{

    public function create(TarefasRequest $request): JsonResponse
    {
        // Garante que os dados que chegam no $request estejam validado de acordo com as regras do TarefasRequest
        $validated = $request->validated();

        $tarefa = Tarefas::create($validated);

        return response()->json([
            'message' => 'Tarefa salva com sucesso!',
            'data' => $tarefa
        ], 201);
    }

    public function listAll(Request $request): JsonResponse
    {
        // Autoriza a listagem de usuários apenas para admins
        $this->authorizeAdmin();

        $query = Tarefas::query();

        // Campos para ordenação
        $validOrderFields = ['data_criacao', 'data_modificacao', 'data_conclusao'];
        $orderField = $request->input('orderField');

        if ($request->has('orderField') && in_array($orderField, $validOrderFields)) {
            $orderDirection = $request->input('orderDirection') === 'desc' ? 'desc' : 'asc'; // Default para 'asc'
            $query->orderBy($orderField, $orderDirection);
        }

        // Filtragem por status
        if ($request->has('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        $tarefas = $query->get();

        if($tarefas->isEmpty()) {
            return response()->json([
                'message' => 'Nenhuma tarefa encontrada!'
            ], 204);
        }

        return response()->json($tarefas, 200);

    }

    public function getById(int $id): JsonResponse
    {
        $tarefa = Tarefas::find($id);

        if(!$tarefa) {
            return response()->json([
                'message' => 'Nenhuma tarefa encontrada!'
            ], 204);
        }

        return response()->json($tarefa, 200);
    }

    // Lista todas as tasks de um usuário específico
    public function listByUserId(Request $request, int $userId): JsonResponse
    {
        $query = Tarefas::where('user_id', $userId);

        // Campos para ordenação
        $validOrderFields = ['data_criacao', 'data_modificacao', 'data_conclusao'];
        $orderField = $request->input('orderField');

        if ($request->has('orderField') && in_array($orderField, $validOrderFields)) {
            $orderDirection = $request->input('orderDirection') === 'desc' ? 'desc' : 'asc'; // Default para 'asc'
            $query->orderBy($orderField, $orderDirection);
        }

        // Filtragem por status
        if ($request->has('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        $tarefas = $query->get();

        if ($tarefas->isEmpty()) {
            return response()->json([
                'message' => 'Nenhuma tarefa encontrada!'
            ], 204);
        }

        return response()->json($tarefas, 200);
    }


    public function update(TarefasRequest $request, int $id): JsonResponse
    {
        $tarefa = Tarefas::find($id);

        if (!$tarefa) {
            return response()->json([
                'message' => 'Nenhuma tarefa encontrada para esse id'
            ], 204);
        }

        $validated = $request->validated();

        $tarefa->update($validated);

        // Atualiza a data de modificação ao atualizar os dados
        $tarefa->data_modificacao = now();
        $tarefa->save();

        return response()->json([
            'message' => 'Tarefa atualizada com sucesso!',
            'data' => $tarefa
        ], 200);
    }

    public function delete(int $id): JsonResponse
    {
        $tarefa = Tarefas::find($id);

        if(!$tarefa) {
            return response()->json([
                'message' => 'Nenhuma tarefa encontrada para esse id'
            ], 204);
        }

        $tarefa->delete();

        return response()->json([
            'message' => 'Tarefa removida com sucesso!'
        ]);
    }

    // Função usada para retornar a contagem que é exibida no Dashboard e no Perfil
    public function countTasksByUserId(int $userId): JsonResponse
    {
        $pendentes = Tarefas::where('user_id', $userId)
            ->where('status', 'Pendente')
            ->count();

        $emAndamento = Tarefas::where('user_id', $userId)
            ->where('status', 'Em andamento')
            ->count();

        $concluidas = Tarefas::where('user_id', $userId)
            ->where('status', 'Concluido')
            ->count();

        return response()->json([
            'pendentes' => $pendentes,
            'emAndamento' => $emAndamento,
            'concluidas' => $concluidas,
        ]);
    }

    // Função para permitir que o admin acesse os endpoints restritos
    public function authorizeAdmin(): void
    {
        if(!auth()->user() || !auth()->user()->admin) {
            abort(403, 'Acesso negado!');
        }
    }
}
