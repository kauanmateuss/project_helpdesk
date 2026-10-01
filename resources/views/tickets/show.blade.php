@extends('layouts.app')

@section('titulo', $ticket->title)

@section('content')
    <a href="{{ route('tickets.index') }}" class="text-blue-600 hover:underline">← Voltar</a>

    <div class="bg-white rounded shadow p-6 mt-4">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $ticket->title }}</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Aberto por <strong>{{ $ticket->user->name }}</strong>
                    em {{ $ticket->created_at->format('d/m/Y H:i') }}
                </p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('tickets.edit', $ticket) }}"
                   class="text-blue-600 hover:underline">Editar</a>

                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST"
                    onsubmit="return confirm('Tem certeza que deseja excluir?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Excluir</button>
</form>
            </div>
        </div>

        <div class="mt-4 flex gap-2">
            <span class="text-xs px-2 py-1 rounded bg-blue-100 text-blue-700">{{ $ticket->status }}</span>
            <span class="text-xs px-2 py-1 rounded bg-yellow-100 text-yellow-700">{{ $ticket->priority }}</span>
            <span class="text-xs px-2 py-1 rounded bg-gray-100 text-gray-700">{{ $ticket->category }}</span>
        </div>

        <div class="mt-6 text-gray-700 whitespace-pre-line">{{ $ticket->description }}</div>
    </div>
@endsection