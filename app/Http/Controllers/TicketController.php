<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Exibir todos os tickets, com paginação e ordenados do mais recente para o mais antigo
        $tickets = \App\Models\Ticket::with('user')->latest()->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id() ?? 1;

        \App\Models\Ticket::create($data);

        return redirect()->route('tickets.index')->with('sucesso', 'Chamado criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = \App\Models\Ticket::with(['user', 'assignee', 'comments.user'])
            ->findOrFail($id);  // Se não encontrar recorna o erro 404

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = \App\Models\Ticket::findOrFail($id);

        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, string $id)
    {
        $ticket = \App\Models\Ticket::findOrFail($id);
        $ticket->update($request->validated());

        return redirect()->route('tickets.show', $ticket)->with('sucesso', 'Chamado atualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // pegando o id no banco
        $ticket = \App\Models\Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('sucesso', 'Chamado Removido');
    }
}
