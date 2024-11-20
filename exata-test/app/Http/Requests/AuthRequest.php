<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post') && $this->routeIs('auth.register')) {
            return [
                'nome' => 'required|string|max:255',
                'nome_usuario' => 'required|string|max:255|unique:users,nome_usuario',
                'password' => 'required|string|min:8|confirmed|regex:/[A-Z]/',
                'admin' => 'boolean',
            ];
        }

        // Caso a rota usada seja a com nome auth.login, ele aplicará as validações abaixo
        if ($this->isMethod('post') && $this->routeIs('auth.login')) {
            return [
                'nome_usuario' => 'required|string|max:255',
                'password' => 'required|string|min:8',
            ];
        }

        return [];
    }

}
