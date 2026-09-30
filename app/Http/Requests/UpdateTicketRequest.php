<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('ticket'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'category' => ['required', 'in:geral,hardware,software,rede'],
            'priority' => ['required', 'string', 'in:baixa, media, alta, urgente'],
        
        ];
    }

    public function messages(): array {
        return [
            'title.required' => 'O titulo é obrigatorio',
            'description.required' => 'A descricao é obrigatoria',
            'description.min' => 'A descricao precisa ter pelo menos 10 caracteres',
            'priority.in' => 'Prioridade Invalida',
        ];
    }
}
