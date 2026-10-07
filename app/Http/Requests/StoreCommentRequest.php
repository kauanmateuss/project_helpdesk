<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Autorizando o usuário que fez a request
        return $this->user()->can('view', $this->route('ticket'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'body' => ['required', 'string', 'min:2', 'max:2000'],
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'body.required' => 'O comentário não pode ser vazio',
            'body.min' => 'O comentario precisa ter pelo menos 2 caracteres',
            'body.max' => 'O comentário não pode passar 2000 caracteres',
        ];
    }
}
