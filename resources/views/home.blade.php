@extends('layouts.app')

<!-- Essa secao vai substituir o titulo por HOME - HELP DESK  que tá no layout app-->
@section('titulo', 'HOME - HELP DESK')

<!-- Vai substituir o yield conteudo no layout app pelo pela sessao abaixo -->
@section('content')
    <h1 class="text-3xl font-bold text-gray-800">🛠️ {{ $titulo }}</h1>
    <p class="text-gray-600 mt-2">{{ $subtitulo }}</p>

    <div class="mt-6 bg-white rounded shadow p-6">
        <p class="text-gray-700">
            Total de chamados:
            <span class="font-bold text-blue-600">{{ $totalChamados }}</span>
        </p>
    </div>

@endsection