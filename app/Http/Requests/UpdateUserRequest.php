<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\UserRole;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; //For now
    }

    public function rules(): array
    {
        return
        [
            'name' => 'nullable|string',
            'email' => 'nullable|email:rfc,dns',
            'password' => 'nullable|string|min:1|max:255|regex:/^[a-zA-Z0-9\W]+$/',
            'role' => ['nullable', 'string', Rule::in(UserRole::cases())]
        ];
    }

    public function attributes()
    {
        return
        [
            'name' => 'nome do usuário',
            'email' => 'email do usuário',
            'password' => 'senha do usuário',
            'role' => 'função do usuário'
        ];
    }

    public function messages()
    {
        return
        [
            'name.string' => 'O nome do usuário deve ser um texto.',
            'email.email' => 'O email deve ser um endereço de email válido.',
            'password.string' => 'A senha deve ser um texto.',
            'password.min' => 'A senha deve ter no mínimo 1 caractere.',
            'password.max' => 'A senha deve ter no máximo 255 caracteres.',
            'password.regex' => 'A senha deve conter letras, números e símbolos.',
            'role.string' => 'A função do usuário deve ser um texto.',
            'role.in' => 'A função do usuário deve ser "employee" ou "admin".'
        ];
    }
}
