<?php

use App\Models\Contrato\Contrato;
use App\Models\Propriedade\Propriedade;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    private string $tableContratos;
    private string $tablePropriedades;

    public function __construct()
    {
        $this->tableContratos = (new Contrato())->getTable();
        $this->tablePropriedades = (new Propriedade())->getTable();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableContratos, function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_propriedade')->constrained($this->tablePropriedades);
            $table->tinyInteger('id_tipo_de_pessoa');
            $table->string('documento_contratante');
            $table->string('email_contratante');
            $table->string('nome_contratante');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableContratos);
    }
}
