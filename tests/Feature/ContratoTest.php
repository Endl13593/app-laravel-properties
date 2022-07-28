<?php

namespace Tests\Feature;

use App\Jobs\ProcessContratoCriado;
use App\Models\Contrato\Contrato;
use App\Models\Contrato\TipoDePessoa;
use App\Models\Propriedade\Propriedade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContratoTest extends TestCase
{
    protected string $endpoint = 'api/contratos';

    public function test_get_all_contratos()
    {
        Propriedade::factory()->count(10)->create();

        for ($i = 0; $i <= 4; $i++) {
            Contrato::factory()->create();
        }

        $response = $this->getJson($this->endpoint);

        $response->assertJsonCount(5, 'paginate.data');
        $response->assertStatus(200);
    }

    public function test_validations_empty_create_contrato()
    {
        $response = $this->postJson($this->endpoint, []);

        $response->assertStatus(422);
    }

    public function test_validations_invalid_create_contrato()
    {
        $response = $this->postJson($this->endpoint, [
            'nome_contratante' => 'faker',
            'email_contratante' => 'faker.com',
            'documento_contratante' => '005.555',
            'id_tipo_de_pessoa' => 1,
            'id_propriedade' => 0
        ]);

        $response->assertJsonValidationErrors(['email_contratante', 'documento_contratante']);
        $response->assertStatus(422);
    }

    public function test_create_contrato()
    {
        $propriedade = Propriedade::factory()->create();

        $response = $this->postJson($this->endpoint, [
            'nome_contratante' => 'faker',
            'email_contratante' => 'faker@faker.com',
            'documento_contratante' => '111.111.111-11',
            'id_tipo_de_pessoa' => TipoDePessoa::FISICA,
            'id_propriedade' => $propriedade->id
        ]);

        $response->assertStatus(201);
    }

    public function test_delete_contrato()
    {
        Propriedade::factory()->create();
        $contrato = Contrato::factory()->create();

        $response = $this->deleteJson("$this->endpoint/fake-id");
        $response->assertStatus(404);

        $response = $this->deleteJson("$this->endpoint/$contrato->id");
        $response->assertStatus(204);
    }

    public function test_get_propriedades_available()
    {
        Propriedade::factory()->count(10)->create();

        $response = $this->getJson("$this->endpoint/propriedades");

        $response->assertJsonCount(10);
        $response->assertStatus(200);
    }

    public function test_get_tipo_de_pessoa()
    {
        $response = $this->getJson("$this->endpoint/tipo-de-pessoa");

        $response->assertJsonCount(2);
        $response->assertStatus(200);
    }
}
