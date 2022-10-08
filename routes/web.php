<?php

use App\Http\Controllers\admin\ContatosController;
use Illuminate\Support\Facades\Route;

Route::controller(ContatosController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/contato', 'create')->middleware(['permission:cadastrar-contato']);
    Route::get('/contato/email/{id}', 'send_email')->middleware(['permission:enviar-email']);
    Route::post('/contato/store', 'store')->middleware(['permission:cadastrar-contato']);
    Route::get('/contato/edit/{id}', 'edit')->middleware(['permission:editar-contato']);
    Route::put('/contato/update/{id}', 'update')->middleware(['permission:editar-contato']);
    Route::delete('/contato/delete/{id}', 'destroy')->middleware(['permission:excluir-contato']);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
