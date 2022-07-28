<?php

namespace App\Http\Requests\Propriedade;

use Illuminate\Foundation\Http\FormRequest;

class PropriedadeFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email_proprietario' => 'required|email:filter',
            'rua'    => 'required',
            'numero' => 'nullable',
            'complemento' => 'nullable',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email_proprietario.required' => 'Por favor informe um e-email válido',
            'email_proprietario.email'    => 'Por favor informe um e-email válido',
            'rua.required'    => 'Por favor informe a rua',
            'bairro.required' => 'Por favor informe o bairro',
            'cidade.required' => 'Por favor informe a cidade',
            'estado.required' => 'Por favor informe o estado'
        ];
    }
}
