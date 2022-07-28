<?php

namespace Tests\Unit;

use App\Models\Contrato\Contrato;
use App\Models\Propriedade\Propriedade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tests\TestCase;

class ContratoTest extends TestCase
{
    public function test_check_if_columns_contratos_is_corrects()
    {
        $contrato = new Contrato();

        $expected = [
            'id_propriedade',
            'id_tipo_de_pessoa',
            'documento_contratante',
            'email_contratante',
            'nome_contratante',
        ];

        $this->assertEquals($expected, $contrato->getFillable());
    }

    public function test_check_if_contratos_use_traits()
    {
        $traits = [
            HasFactory::class,
            SoftDeletes::class,
        ];

        $contratoTraits = array_keys(class_uses(Contrato::class));

        $this->assertEquals($traits, $contratoTraits);
    }

    public function test_check_if_contratos_use_casts()
    {
        $casts = [
            'id' => 'int',
            'created_at' => 'datetime:d/m/Y H:i:s',
            'updated_at' => 'datetime:d/m/Y H:i:s',
            'deleted_at' => 'datetime'

        ];

        $contrato = new Contrato();

        $this->assertEquals($casts, $contrato->getCasts());
    }

    public function test_check_if_contratos_use_relationships()
    {
        $this->assertTrue(method_exists(Contrato::class, 'propriedade'));
    }
}
