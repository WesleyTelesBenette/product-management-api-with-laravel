<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; //For now
    }

    public function rules(): array
    {
        return
        [
            'name' => 'nullable|string|min:1|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|numeric',
            'amount' => 'nullable|numeric',
            'price' => 'nullable|numeric|min:0.01|max:9999999999'
        ];
    }

    public function attributes()
    {
        return
        [
            'name' => 'nome do produto',
            'description' => 'descrição do produto',
            'category_id' => 'id da categoria do produto',
            'amount' => 'quantidade do produto em estoque',
            'price' => 'preço do produto'
        ];
    }

    public function messages()
    {
        return
        [
            'name.string' => 'O nome do produto deve ser uma string.',
            'name.min' => 'O nome do produto não pode ter menos que 1 caracter.',
            'name.max' => 'O nome do produto não pode ter mais que 255 caracteres.',
            'description.string' => 'A descrição do produto deve ser uma string.',
            'category_id.numeric' => 'O id categoria do produto deve ser um número.',
            'amount.numeric' => 'A quantidade do produto em estoque deve ser um número.',
            'price.numeric' => 'O preço do produto deve ser um número.',
            'price.min' => 'O preço do produto não pode ser menor que "0.01".',
            'price.max' => 'O preço do produto não pode ser maior que "9999999999".'

        ];
    }
}
