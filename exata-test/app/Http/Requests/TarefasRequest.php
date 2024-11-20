<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarefasRequest extends FormRequest
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
        $rules = [
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'nullable|in:Pendente,Em andamento,Concluido',
            'data_modificacao' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
        ];

        // Caso o metodo http seja put ou patch, ele aplicará as validações abaixo
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['status'] = 'nullable|in:Pendente,Em andamento,Concluido';
            $rules['titulo'] = 'nullable|string|max:255';
            unset($rules['user_id']);
        }

        return $rules;
    }
}
