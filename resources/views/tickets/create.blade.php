@extends('layouts.app')

@section('titulo', 'NOVO CHAMADO')

@section('conteudo')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">➕ Novo Chamado</h1>

    <form action="{{ route('tickets.store') }}" method="POST"
          class="bg-white rounded shadow p-6 space-y-4 max-w-2xl">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium mb-1">Título</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border rounded px-3 py-2 @error('title') border-red-500 @enderror">
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-1">Descrição</label>
            <textarea name="description" rows="4"
                      class="w-full border rounded px-3 py-2 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Categoria</label>
                <select name="category" class="w-full border rounded px-3 py-2">
                    <option value="geral"     @selected(old('category') === 'geral')>Geral</option>
                    <option value="hardware"  @selected(old('category') === 'hardware')>Hardware</option>
                    <option value="software"  @selected(old('category') === 'software')>Software</option>
                    <option value="rede"      @selected(old('category') === 'rede')>Rede</option>
                </select>
                @error('category')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Prioridade</label>
                <select name="priority" class="w-full border rounded px-3 py-2">
                    <option value="baixa"    @selected(old('priority') === 'baixa')>Baixa</option>
                    <option value="media"    @selected(old('priority') === 'media')>Média</option>
                    <option value="alta"     @selected(old('priority') === 'alta')>Alta</option>
                    <option value="urgente"  @selected(old('priority') === 'urgente')>Urgente</option>
                </select>
                @error('priority')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Criar Chamado
            </button>
            <a href="{{ route('tickets.index') }}"
               class="text-gray-600 px-4 py-2 rounded hover:bg-gray-100">
                Cancelar
            </a>
        </div>
    </form>

@endsection