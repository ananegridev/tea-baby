<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvidadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convidados', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('telefone');
            $table->string('cod_convite');
            $table->enum('presenca', ['sim', 'talvez', 'nao']);
            $table->integer('qtd_presente');
            $table->enum('status', ['pendente', 'aceito', 'negado'])->default('pendente');
            // tipo de convite, se foi enviado por landing page ou o usuário cadastrado adicionou em 'lista de convidados'
            $table->enum('tipo_convite', ['enviado', 'convidado']);
            $table->foreignId('presente_id')->constrained()->onDelete('cascade');
            $table->foreignId('evento_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('convidados');
    }
}
