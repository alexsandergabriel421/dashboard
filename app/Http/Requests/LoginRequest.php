<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'E-mail inválido.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ];
    }
    
}
