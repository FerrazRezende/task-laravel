<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'nome' => 'nullable|string|max:255',
            'nome_usuario' => 'nullable|string|max:255|unique:users,nome_usuario,' . $this->route('id'),
            'password' => 'nullable|string|min:8',
            'admin' => 'nullable|boolean',
        ];
    }
}
