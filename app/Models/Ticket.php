<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'assigned_to',
        'title',
        'description',
        'category',
        'priority',
        'status',
    ];

    // relacionamento, um ticket pertence a um user(quem abriu o ticket)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // relacionamento onde um ticket pode estar relacionado a um admin
    public function assignee() {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // relacionamento onde um ticket tem vários comentários
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
