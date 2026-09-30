@extends('layouts.app')

@section('titulo', 'Editar Chamado')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">✏️ Editar Chamado #{{ $ticket->id }}</h1>

    <form action="{{ route('tickets.update', $ticket) }}" method="POST"
          class="bg-white rounded shadow p-6 space-y-4 max-w-2xl">
        @csrf
        @method('PUT')

        {{-- os mesmos campos do create, mas usando old('campo', $ticket->campo) --}}

        <div>
            <label class="block text-gray-700 font-medium mb-1">Título</label>
            <input type="text" name="title" value="{{ old('title', $ticket->title) }}"
                   class="w-full border rounded px-3 py-2 @error('title') border-red-500 @enderror">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Descrição</label>
            <textarea name="description" rows="4"
                      class="w-full border rounded px-3 py-2">{{ old('description', $ticket->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Categoria</label>
                <select name="category" class="w-full border rounded px-3 py-2">
                    @foreach (['geral','hardware','software','rede'] as $cat)
                        <option value="{{ $cat }}" @selected(old('category', $ticket->category) === $cat)>
                            {{ ucfirst($cat) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Prioridade</label>
                <select name="priority" class="w-full border rounded px-3 py-2">
                    @foreach (['baixa','media','alta','urgente'] as $pri)
                        <option value="{{ $pri }}" @selected(old('priority', $ticket->priority) === $pri)>
                            {{ ucfirst($pri) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Salvar Alterações
            </button>
            <a href="{{ route('tickets.show', $ticket) }}"
               class="text-gray-600 px-4 py-2 rounded hover:bg-gray-100">Cancelar</a>
        </div>
    </form>
@endsection