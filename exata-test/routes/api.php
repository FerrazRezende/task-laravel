<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TarefasController;

use Illuminate\Support\Facades\Route;



// --------------
// - Rotas Auth -
// --------------
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/check', [AuthController::class, 'check'])->middleware('auth:sanctum');


// --------------
// - CRUD User -
// --------------
Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::get('/users/page', [UserController::class, 'listAllPage'])->middleware('auth:sanctum');
Route::get('/users/{id}', [UserController::class, 'getUserById'])->middleware('auth:sanctum');
Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/users/{id}', [UserController::class, 'delete'])->middleware('auth:sanctum');

// ----------------
// - CRUD Tarefas -
// ----------------
Route::post('/tarefas', [TarefasController::class, 'create'])->middleware('auth:sanctum');
Route::get('/tarefas', [TarefasController::class, 'listAll'])->middleware('auth:sanctum');
Route::get('/tarefas/{task_id}', [TarefasController::class, 'getById'])->middleware('auth:sanctum');
Route::get('/tarefas/user/{user_id}', [TarefasController::class, 'listByUserId'])->middleware('auth:sanctum');
Route::put('/tarefas/{id}', [TarefasController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/tarefas/{id}', [TarefasController::class, 'delete'])->middleware('auth:sanctum');
Route::get('/tarefas/{user_id}/count', [TarefasController::class, 'countTasksByUserId'])->middleware('auth:sanctum');


