<?php

namespace Database\Factories\Contrato;

use App\Models\Contrato\Contrato;
use App\Models\Contrato\TipoDePessoa;
use App\Models\Propriedade\Propriedade;
use App\Models\Propriedade\StatusPropriedade;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratoFactory extends Factory
{
    protected $model = Contrato::class;

    protected function withFaker(): \Faker\Generator
    {
        return \Faker\Factory::create('pt_BR');
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $idTipoDePessoa = $this->faker->numberBetween(1, 2);

        if($idTipoDePessoa === TipoDePessoa::FISICA)
        {
            $documento = $this->faker->cpf();
        }else{
            $documento = $this->faker->cnpj();
        }

        return [

            'id_propriedade'        => Propriedade::where('id_status', '=', StatusPropriedade::NAO_CONTRATADO)->first()->id,
            'id_tipo_de_pessoa'     => $idTipoDePessoa,
            'documento_contratante' => $documento,
            'email_contratante'     => $this->faker->email(),
            'nome_contratante'      => $this->faker->name(),

        ];
    }
}
