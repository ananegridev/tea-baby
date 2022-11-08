<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriaEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('icone');
            $table->longText('descricao');
            $table->enum('assinatura', ['gratuito', 'premium']);
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
        Schema::dropIfExists('categoria_eventos');
    }
}
