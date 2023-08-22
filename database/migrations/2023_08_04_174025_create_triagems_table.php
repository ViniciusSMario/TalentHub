<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriagemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('triagems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vaga_id');
            $table->foreign('vaga_id')->references('id')->on('vagas');
            $table->unsignedBigInteger('candidato_id');
            $table->foreign('candidato_id')->references('id')->on('candidatos');
            $table->boolean('analise_curriculo')->default(1);
            $table->boolean('teste_comportamental')->default(0);
            $table->boolean('teste_pratico')->default(0);
            $table->boolean('entrevista')->default(0);
            $table->boolean('reprovado')->default(0);
            $table->boolean('aprovado')->default(0);
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
        Schema::dropIfExists('triagems');
    }
}
