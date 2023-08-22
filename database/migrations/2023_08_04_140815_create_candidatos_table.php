<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->longText('url_curriculo');
            $table->enum('sexo', ['masculino', 'feminino'])->nullable();
            $table->date('data_nascimento');
            $table->longText('url_linkedin')->nullable();
            $table->longText('url_site')->nullable();
            $table->longText('url_instagram')->nullable();
            $table->longText('url_facebook')->nullable();
            $table->string('endereco');
            $table->string('numero');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('telefone_contato');
            $table->enum('estado_civil', ['solteiro', 'casado', 'divorciado', 'viuvo'])->nullable();
            $table->longText('referencias')->nullable();
            $table->longText('informacoes_adicionais')->nullable();
            $table->unsignedBigInteger('vaga_id');
            $table->foreign('vaga_id')->references('id')->on('vagas');
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
        Schema::dropIfExists('candidatos');
    }
}
