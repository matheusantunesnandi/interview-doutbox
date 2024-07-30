<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Para Route::resource o Laravel mapeia automaticamente conforme https://laravel.com/docs/10.x/controllers#actions-handled-by-resource-controllers

// TODO Implementar um middleware group para todas as rotas com bjetivo de tratar exceções e também verbos HTTP não aceitos.
// Isso para não mostrar uma página do Laravel ao usuário e muito menos mostrar dados da exceção como estrutura do projeto etc.

// TODO Padronizar as views conforme os nomes dos métodos dos resources. index, create e etc.


Route::get('/', [PostController::class, 'index']);

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, "index"])->name('login');
    Route::post('/login', [AuthController::class, "store"]);
    Route::get('/register', [UserController::class, "create"]);
    Route::post('/register', [UserController::class, "store"]);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class)->except('index', 'show');
    Route::resource('comments', PostCommentController::class)->only('store', 'destroy');

    Route::delete('/logout', [AuthController::class, "destroy"]);

    // TODO Configurar o UserController com Route::resource e por antes das rotas manuais:
    Route::get('/users', [UserController::class, "index"])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, "destroy"])->name('users.destroy');
    Route::post('/users/{user}/make-admin', [UserController::class, "makeAdmin"]);
    Route::post('/users/{user}/revoke-admin', [UserController::class, "revokeAdmin"]);
});

// Rotas manuais do post definidas após os resources, senão são reconfiguradas pelo resource:
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
