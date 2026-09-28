<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Rota da pagina inicial Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// rota para a pagina sobre
Route::get('/sobre', [HomeController::class, 'sobre'])->name('sobre');

// Rotas com parametro
Route::get('/ola/{nome}', function($nome) {
    return "Olá, {$nome}";
});

Route::get('/chamado/{id}', function($id) {
    return "Detalhes do chamado #{$id}";

});