<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Ticket;

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
        abort_unless($comment->user_id === auth()->id(), 403);

        $ticket = $comment->ticket;
        $comment->delete();

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('sucesso', 'Comentário Removido');
    }
}
