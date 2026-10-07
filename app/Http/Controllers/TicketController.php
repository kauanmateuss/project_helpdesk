<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Exibir todos os tickets, com paginação e ordenados do mais recente para o mais antigo
        // $tickets = Ticket::where('user_id', auth()->id())
        //     ->with('user')
        //     ->latest()
        //     ->paginate(10);

        // retornando como orientado por igor
        $tickets = auth()->user()->tickets()->with('user')->latest()->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tickets.create');  // Mostra a página com formulário
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $data = $request->validated();
        // Criando o ticket com o usuário logado
        $ticket = auth()->user()->tickets()->create($data);

        // QUando criado, redireciona para a pagina show
        return redirect()
            ->route('tickets.show', $ticket)
            ->with('sucesso', 'Chamado criado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        // verifica se o usuário é autorizado a ver esse ticket
        Gate::authorize('view', $ticket);

        $ticket->load(['user', 'assignee', 'comments.user']);

        return view('tickets.show', compact('ticket'));  // vai para a pagina de mostrar o registro ticket
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        Gate::authorize('update', $ticket);

        return view('tickets.edit', compact('ticket'));  // Vai para o formulário de edição do chamado
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        Gate::authorize('update', $ticket);
        $ticket->update($request->validated());

        return redirect()
            ->route('tickets.index')
            ->with('sucesso', 'Chamado atualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        Gate::authorize('delete', $ticket);
        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('sucesso', 'Chamado Removido');
    }
}
