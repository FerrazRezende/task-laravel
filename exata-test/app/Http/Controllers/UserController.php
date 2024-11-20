<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // Endpoint para listagem de todos os usuários cadastrados.
    // Acesso apenas a administradores.

    // Há dois enpoints para listagem: um com paginação e um sem. O endpoint sem paginação é usado
    // para exibir os dados no form select do filtro de usuários, liberados apenas para admins
    public function index(): JsonResponse
    {
        $this->authorizeAdmin();

        $users = User::all();

        return response()->json($users, 200);
    }

    // Todos os usuários com paginação, para ser exibido na tabela de usuários
    public function listAllPage(): JsonResponse
    {
        $this->authorizeAdmin();

        $users = User::paginate(10);

        return response()->json($users, 200);
    }

    public function getUserById(int $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuário não encontrado'
            ], 204);
        }

        return response()->json($user, 200);
    }

    public function update(UserRequest $request, int $id): JsonResponse
    {
        $user = User::find($id);

        if (!$user) {
          return response()->json([
              'message' => 'Usuário não encontrado'
          ], 204);
        }

        $validated = $request->validated();

        $user->update($validated);

        return response()->json($user, 200);
    }

    // Somente admin pode excluir um usuário
    public function delete(int $id): JsonResponse
    {
        $this->authorizeAdmin();

        $user = User::find($id);

        if(!$user){
            return response()->json([
                'message' => 'Usuário não encontrado'
            ], 204);
        }

        $user->delete();

        return response()->json([
            'message' => 'Usuário deletado com sucesso!'
        ], 200);
    }

    // Função para permitir que o admin acesse os endpoints restritos
    public function authorizeAdmin(): void
    {
        if(!auth()->user() || !auth()->user()->admin) {
            abort(403, 'Acesso negado!');
        }
    }
}
