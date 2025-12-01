<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'min:3'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'min:6']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.min'      => 'O nome deve ter no mínimo :min caracteres.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email'    => 'Informe um e-mail válido.',

            'password.required' => 'A senha é obrigatória.',
            'password.min'      => 'A senha deve ter no mínimo :min caracteres.',
        ];
    }
}
