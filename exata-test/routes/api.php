<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;



// --------------
// - Rotas Auth -
// --------------
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/check', [AuthController::class, 'check'])->middleware('auth:sanctum');


// --------------
// - CRUD User -
// --------------
Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::get('/users/{id}', [UserController::class, 'getUserById'])->middleware('auth:sanctum');
Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/users/{id}', [UserController::class, 'delete'])->middleware('auth:sanctum');

// ----------------
// - CRUD Tarefas -
// ----------------
