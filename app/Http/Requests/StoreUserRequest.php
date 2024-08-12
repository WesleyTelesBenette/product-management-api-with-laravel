<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\UserRole;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; //For now
    }

    public function rules(): array
    {
        return
        [
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|string|min:1|max:255|regex:/^[a-zA-Z0-9\W]+$/',
            'role' => ['required', 'string', Rule::in(UserRole::cases())]
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
            'name.required' => 'O nome do usuário é obrigatório.',
            'name.string' => 'O nome do usuário deve ser um texto.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'O email deve ser um endereço de email válido.',
            'password.required' => 'A senha é obrigatória.',
            'password.string' => 'A senha deve ser um texto.',
            'password.min' => 'A senha deve ter no mínimo 1 caractere.',
            'password.max' => 'A senha deve ter no máximo 255 caracteres.',
            'password.regex' => 'A senha deve conter letras, números e símbolos.',
            'role.required' => 'A função do usuário é obrigatória.',
            'role.string' => 'A função do usuário deve ser um texto.',
            'role.in' => 'A função do usuário deve ser "employee" ou "admin".'
        ];
    }
}
