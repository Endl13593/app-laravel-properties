<?php

namespace Tests\Unit;

use App\Models\Propriedade\Propriedade;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tests\TestCase;

class PropriedadeTest extends TestCase
{
    public function test_check_if_columns_propriedades_is_corrects()
    {
        $propriedade = new Propriedade();

        $expected = [
            'email_proprietario',
            'bairro',
            'rua',
            'numero',
            'complemento',
            'cidade',
            'estado',
            'id_status'
        ];

        $this->assertEquals($expected, $propriedade->getFillable());
    }

    public function test_check_if_propriedades_use_traits()
    {
        $traits = [
            HasFactory::class,
            SoftDeletes::class,
        ];

        $propriedadeTraits = array_keys(class_uses(Propriedade::class));

        $this->assertEquals($traits, $propriedadeTraits);
    }

    public function test_check_if_propriedades_use_casts()
    {
        $casts = [
            'id' => 'int',
            'created_at' => 'datetime:d/m/Y H:i:s',
            'updated_at' => 'datetime:d/m/Y H:i:s',
            'deleted_at' => 'datetime'

        ];

        $propriedade = new Propriedade();

        $this->assertEquals($casts, $propriedade->getCasts());
    }
}
