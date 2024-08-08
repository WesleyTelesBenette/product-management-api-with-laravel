<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; //For now
    }

    public function rules(): array
    {
        return ['name' => 'required|string|max:255|min:1'];
    }

    public function attributes()
    {
        return ['name' => 'nome da categoria'];
    }

    public function messages()
    {
        return
        [
            'name.required' => 'O nome da categoria é obrigatório.',
            'name.string' => 'O nome da categoria deve ser uma string.',
            'name.max' => 'O nome da categoria não pode ter mais de 255 caracteres.'
        ];
    }
}
