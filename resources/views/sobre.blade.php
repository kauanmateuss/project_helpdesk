@extends('layouts.app')

@section('titulo', 'SOBRE - HELP DESK')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800">Sobre o projeto</h1>

    <div class="mt-4 bg-white rounded shadow p-6">
        <p class="text-gray-700">
            Este é um sistema de controle de chamados feito em
            <strong>Laravel {{ app()->version() }}</strong>.
        </p>
        <p class="text-gray-700 mt-2">
            Banco de dados: <code class="bg-gray-100 px-2 py-1 rounded">SQLite</code>
        </p>
    </div>

    <a href="{{ route('home') }}"
       class="inline-block mt-6 text-blue-600 hover:underline">
        ← Voltar para home
    </a>

@endsection