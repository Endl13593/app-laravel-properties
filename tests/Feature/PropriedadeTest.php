<?php

namespace Tests\Feature;

use App\Jobs\ProcessPropriedadeCriada;
use App\Models\Propriedade\Propriedade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropriedadeTest extends TestCase
{
    protected string $endpoint = 'api/propriedades';

    public function test_get_all_propriedades()
    {
        Propriedade::factory()->count(8)->create();

        $response = $this->getJson($this->endpoint);

        $response->assertJsonCount(8, 'paginate.data');
        $response->assertStatus(200);
    }

    public function test_validations_empty_create_propriedade()
    {
        $response = $this->postJson($this->endpoint, []);

        $response->assertStatus(422);
    }

    public function test_validations_invalid_create_propriedade()
    {
        $response = $this->postJson($this->endpoint, [
            'email_proprietario' => 'fake_email.com',
            'rua' => 'faker',
            'numero' => '0',
            'complemento' => 'faker',
            'bairro' => 'faker',
            'cidade' => 'faker',
            'estado' => 'faker'
        ]);

        $response->assertJsonValidationErrors(['email_proprietario']);
        $response->assertStatus(422);
    }

    public function test_create_propriedade()
    {
        $response = $this->postJson($this->endpoint, [
            'email_proprietario' => 'fake_email@faker.com',
            'rua' => 'faker',
            'numero' => null,
            'complemento' => null,
            'bairro' => 'faker',
            'cidade' => 'faker',
            'estado' => 'faker'
        ]);

        $response->assertStatus(201);
    }

    public function test_delete_propriedade()
    {
        $propriedade = Propriedade::factory()->create();

        $response = $this->deleteJson("$this->endpoint/fake-id");
        $response->assertStatus(404);

        $response = $this->deleteJson("$this->endpoint/$propriedade->id");
        $response->assertStatus(204);
    }
}
