<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    // criando um método
    public function index()
    {
        // criando dados para passar para view
        $titulo = 'Help desk';
        $subtitulo = 'Sistema de Controle de Chamado';
        $totalChamados = 0;

        // retornando uma lista chaves valores
        return view('welcome', [
            'titulo' => $titulo,
            'subtitulo' => $subtitulo,
            'totalChamados' => $totalChamados,
        ]);
    }

    public function sobre()
    {
        return view('sobre');
    }
}
