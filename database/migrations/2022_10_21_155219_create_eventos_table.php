<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('mes_gestacao');
            $table->string('sexo_bebe');
            $table->date('data_evento');
            $table->string('nome_baby');
            $table->string('link_pagina');
            $table->string('titulo');
            $table->longText('sobre');
            $table->string('celular');
            $table->string('cep');
            $table->string('endereco');
            $table->integer('numero_endereco');
            $table->string('complemento');
            $table->string('cidade');
            $table->string('estado');
            $table->string('ponto_referencia');
            $table->foreignId('categoria_evento_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('eventos');
    }
}
