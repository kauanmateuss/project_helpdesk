<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_authorized_user_can_update_a_ticket_with_a_valid_priority(): void
    {
        $user = User::factory()->create();
        $ticket = $user->tickets()->create([
            'title' => 'Título original',
            'description' => 'Descrição original com mais de dez caracteres',
            'category' => 'geral',
            'priority' => 'baixa',
        ]);

        $response = $this
            ->actingAs($user)
            ->put(route('tickets.update', $ticket), [
                'title' => 'Título atualizado',
                'description' => 'Descrição atualizada com mais de dez caracteres',
                'category' => 'software',
                'priority' => 'alta',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertSessionHas('sucesso', 'Chamado atualizado')
            ->assertRedirect(route('tickets.index'));

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'title' => 'Título atualizado',
            'description' => 'Descrição atualizada com mais de dez caracteres',
            'category' => 'software',
            'priority' => 'alta',
        ]);
    }
}
