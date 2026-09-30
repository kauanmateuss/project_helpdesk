@extends('layouts.app')

@section('titulo', 'CHAMADOS - HELP DESK')

@section('content')
    @if (session('sucesso'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('sucesso') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">📋 Chamados</h1>
        <a href="{{ route('tickets.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Novo Chamado
        </a>
    </div>

    @if ($tickets->isEmpty())
        <div class="bg-white rounded shadow p-8 text-center text-gray-500">
            Nenhum chamado cadastrado ainda.
        </div>
    @else
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 text-gray-600 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Título</th>
                        <th class="px-4 py-3 text-left">Solicitante</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Prioridade</th>
                        <th class="px-4 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($tickets as $ticket)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-500">{{ $ticket->id }}</td>
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $ticket->title }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $ticket->user->name }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded bg-blue-100 text-blue-700">
                                    {{ $ticket->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $ticket->priority }}</td>
                            <td class="px-4 py-3 text-right text-sm">
                                <a href="{{ route('tickets.show', $ticket) }}"
                                   class="text-blue-600 hover:underline">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $tickets->links() }}
        </div>
    @endif

@endsection