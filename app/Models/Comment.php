<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'body',
    ];

    // relacionamento do comentário com um ticket
    public function ticket()
    {
        return $this->BelongsTo(Ticket::class);
    }

    // relacionamento do comentário com o usuário que comentou
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
