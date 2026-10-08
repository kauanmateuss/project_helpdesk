<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,   // define o tipo de dado do campo role como UserRole
        ];
    }

    // relacionamento: um usuario pode abrir varios tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // relacionamento: usuário pode ta atribuido a varios tickets
    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    // relacionamento: um cliente pode realizar varios comentários
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // metodos para verificar o papel do usuário
    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }

    public function isCliente(): bool
    {
        return $this->role === UserRole::Cliente;
    }

    public function isAgente(): bool
    {
        return $this->role === UserRole::Agente;
    }
}
