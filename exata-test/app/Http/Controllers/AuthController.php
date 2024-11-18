<?php

namespace App\Http\Controllers;


use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(AuthRequest $request): JsonResponse
    {
        $user = User::create([
            'nome' => $request->nome,
            'nome_usuario' => $request->nome_usuario,
            'password' => Hash::make($request->password),
            'admin' => $request->admin ?? false,
        ]);

        if (!$user) {
            return response()->json([
                'message' => 'Um erro ocorreu ao cadastrar o usuário!',
            ], 400);
        }

        return response()->json([
            'message' => 'Usuário cadastrado com sucesso!'
        ], 200);

    }


    public function login(AuthRequest $request): JsonResponse
    {

        if (!Auth::attempt(['nome_usuario' => $request->nome_usuario, 'password' => $request->password])) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user_id' => $user->id,
            'is_admin' => $user->admin ?? false,
        ], 200);
    }


    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }


    public function check(Request $request): JsonResponse
    {
        $user = Auth::user();

        if ($user) {
            return response()->json([
                'message' => 'Sessão válida',
                'user_id' => $user->id,
                'is_admin' => $user->admin ?? false,
            ]);
        }

        return response()->json([
            'message' => 'Sessão inválida, efetue o login novamente!'
        ], 401);
    }
}
