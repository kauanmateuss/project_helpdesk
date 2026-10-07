<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Ticket $ticket) {
        $ticket->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->validated('body'),
        ]);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('sucesso', 'Comentário Adicionado');
    }


    public function destroy(Comment $comment) {
        // só o autor pode deletar
        Gate::authorize('delete', $comment);

        // pegando o ticket relacionado ao comentario para redirecionar depois
        $ticket = $comment->ticket;

        // deletando o comentario
        $comment->delete();

        // redirecionando para a página do ticket e exibindo mensagem de sucesso
        return redirect()
            ->route('tickets.show', $ticket)
            ->with('sucesso', 'Comentário Removido');
    }
}
