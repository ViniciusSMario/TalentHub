<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vagas', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nome');
            $table->longText('descricao');
            $table->enum('tipo_vaga', ['presencial', 'remoto', 'hibrido']);
            $table->longText('atividades');
            $table->longText('pre_requisitos');
            $table->string('nivel');
            $table->decimal('remuneracao', 10, 2);
            $table->longText('beneficios');
            $table->string('empresa');
            $table->dateTime('datahora_fechamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vagas');
    }
}
