<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TicketController;

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


// registrando rota resource para o controller ticket
Route::resource('tickets', TicketController::class);