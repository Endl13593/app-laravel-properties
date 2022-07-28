<?php

namespace Database\Factories\Propriedade;

use App\Models\Propriedade\Propriedade;
use App\Models\Propriedade\StatusPropriedade;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropriedadeFactory extends Factory
{
    protected $model = Propriedade::class;

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
        return [
            'email_proprietario' => $this->faker->email(),
            'bairro'             => $this->faker->streetName(),
            'rua'                => $this->faker->streetAddress(),
            'numero'             => $this->faker->numberBetween(1000, 9999),
            'complemento'        => $this->faker->sentence(1),
            'estado'             => $this->faker->state(),
            'cidade'             => $this->faker->city(),
            'id_status'          => StatusPropriedade::NAO_CONTRATADO,
        ];
    }
}
