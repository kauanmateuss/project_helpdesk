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

    {{-- Seção de comentários --}}
    <div class="bg-white rounded shadow p-6 mt-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            💬 Comentários ({{ $ticket->comments->count() }})
        </h2>

        {{-- Lista --}}
        @forelse ($ticket->comments as $comment)
            <div class="border-l-4 border-blue-200 pl-4 py-2 mb-4">
                <div class="flex justify-between items-start">
                    <div>
                        <strong class="text-gray-800">{{ $comment->user->name }}</strong>
                        <span class="text-xs text-gray-500 ml-2">
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                    </div>

                    @if ($comment->user_id === auth()->id())
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                            onsubmit="return confirm('Remover comentário?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-xs hover:underline">
                                Remover
                            </button>
                        </form>
                    @endif
                </div>
                <p class="text-gray-700 mt-1 whitespace-pre-line">{{ $comment->body }}</p>
            </div>
        @empty
            <p class="text-gray-500 text-sm">Ainda não há comentários.</p>
        @endforelse

        {{-- Form de novo comentário --}}
        <form action="{{ route('comments.store', $ticket) }}" method="POST" class="mt-6 space-y-3">
            @csrf

            <textarea name="body" rows="3"
                    placeholder="Escreva um comentário..."
                    class="w-full border rounded px-3 py-2 @error('body') border-red-500 @enderror">{{ old('body') }}</textarea>

            @error('body')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Comentar
            </button>
        </form>
    </div>
@endsection