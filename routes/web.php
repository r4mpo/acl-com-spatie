<?php

use App\Http\Controllers\admin\ContatosController;
use App\Http\Controllers\admin\RolesController;
use Illuminate\Support\Facades\Route;

/**
 * As rotas são agrupadas por controllers e, além disso,
 * recebem a proteção middleware, só podendo ser acessadas
 * por usuários permitidos
*/

Route::controller(ContatosController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/contato', 'create')->middleware(['permission:Cadastrar contato']);
    Route::post('/contato/store', 'store')->middleware(['permission:Cadastrar contato']);
    Route::get('/contato/email/{id}', 'send_email')->middleware(['permission:Enviar e-mail']);
    Route::get('/contato/edit/{id}', 'edit')->middleware(['permission:Editar contato']);
    Route::put('/contato/update/{id}', 'update')->middleware(['permission:Editar contato']);
    Route::delete('/contato/delete/{id}', 'destroy')->middleware(['permission:Excluir contato']);
});

Route::controller(RolesController::class)->group(function () {
    Route::get('/painel', 'index')->middleware(['permission:Visualizar painel administrativo']);
    Route::get('/role', 'create')->middleware(['permission:Cadastrar perfil de acesso']);
    Route::post('/role/store', 'store')->middleware(['permission:Cadastrar perfil de acesso']);
    Route::get('/role/show/{id}', 'show')->middleware(['permission:Visualizar perfil de acesso']);
    Route::get('/role/edit/{id}', 'edit')->middleware(['permission:Editar perfil de acesso']);
    Route::put('/role/update/{id}', 'update')->middleware(['permission:Editar perfil de acesso']);
    Route::delete('/role/delete/{id}', 'destroy')->middleware(['permission:Excluir perfil de acesso']);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
            return view('dashboard');
        }
        )->name('dashboard');
    });