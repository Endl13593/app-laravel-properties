<?php

namespace App\Http\Requests\Contrato;

use App\Models\Contrato\TipoDePessoa;
use App\Models\Propriedade\Propriedade;
use App\Models\Propriedade\StatusPropriedade;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int id_propriedade
 * @property string email_contratante
 * @property int nome_contratante
 * @property int id_tipo_de_pessoa
 * @property string documento_contratante
 */
class ContratoFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rule =  [
            'id_propriedade'    => ['required', 'integer', 'min:1', $this->isAvailable()],
            'email_contratante' => 'required|email:filter',
            'nome_contratante'  => 'required|string|min:3',
            'documento_contratante' => 'required',
            'id_tipo_de_pessoa'    => 'required|integer|min:1',
        ];

        if($this->id_tipo_de_pessoa === TipoDePessoa::FISICA)
        {
            $rule['documento_contratante'] = 'regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/';
        }

        if($this->id_tipo_de_pessoa === TipoDePessoa::JURIDICA)
        {
            $rule['documento_contratante'] = 'regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/';
        }

        return $rule;
    }

    public function messages(): array
    {
        return [
            'id_propriedade.required'    => 'Selecione uma propriedade',
            'id_propriedade.integer'     => 'Propriedade inválida',
            'id_propriedade.min'         => 'Selecione uma propriedade',
            'email_contratante.required' => 'Informe o e-mail do contratante',
            'email_contratante.email'    => 'Informe o e-mail do contratante corretamente',
            'nome_contratante.required'  => 'Informe o nome do contratante',
            'nome_contratante.string'    => 'Informe o nome do contratante corretamente',
            'nome_contratante.min'       => 'Nome do contratante deve ter pelo menos 3 caracteres',
            'documento_contratante.required' => 'Informe o documento do contratante',
            'documento_contratante.regex'    => 'Informe o documento do contratante corretamente',
            'id_tipo_de_pessoa.required'     => 'Informe o tipo de pessoa',
            'id_tipo_de_pessoa.integer'      => 'Informe o tipo de pessoa corretamente',
            'id_tipo_de_pessoa.min'          => 'Informe o tipo de pessoa corretamente',
        ];
    }

    private function isAvailable(): \Closure
    {
        return function ($attribute, $value, $fail)
        {
            $propriedade = Propriedade::where('id', '=', $this->id_propriedade)
                ->where('id_status', '=', StatusPropriedade::CONTRATADO)
                ->first();

            if ($propriedade)
            {
                $fail('Esta propriedade já se encontra em Contrato');
            }

        };
    }
}
