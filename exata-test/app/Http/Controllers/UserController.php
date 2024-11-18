<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorizeAdmin();

        $users = User::all();

        return response()->json($users, 200);
    }

    public function getUserById(int $id): JsonResponse
    {
        $this->authorizeAdmin();

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
        $this->authorizeAdmin();

        $user = User::find($id);

        if (!$user) {
          return response()->json([
              'message' => 'Usuário não encontrado'
          ], 204);
        }

        $validated = $request->validated();


        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json($user, 200);
    }

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

    private function authorizeAdmin(): void
    {
        if(!auth()->user() || !auth()->user()->admin) {
            abort(403, 'Acesso negado!');
        }
    }
}
