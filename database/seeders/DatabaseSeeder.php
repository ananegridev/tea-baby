<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'conta' => 'super_admin',
            'email' => 'super_adm@email.com'
        ]);

        \App\Models\User::factory()->create([
            'conta' => 'funcionario',
            'email' => 'funcionario@email.com',
            'cpf' => '999.999.999-99',
            'dt_nasc' => '1996-01-01',
            'plano' => 'gratuito'
        ]);
        
        $usuario = \App\Models\User::factory()->create([
            'conta' => 'usuario_comum',
            'email' => 'usuario@email.com',
            'cpf' => '999.999.999-99',
            'dt_nasc' => '1996-01-01',
            'plano' => 'gratuito'
        ]);
        

        \App\Models\User::factory(20)->create([
            'conta' => 'usuario_comum',
            'cpf' => '999.999.999-99',
            'dt_nasc' => '1996-01-01',
            'plano' => 'gratuito'
        ]);
        \App\Models\User::factory(20)->create([
            'conta' => 'usuario_comum',
            'cpf' => '999.999.999-99',
            'dt_nasc' => '1996-01-01',
            'plano' => 'premium',
        ]);

        $categoriaEvento = \App\Models\CategoriaEvento::factory()->create([
            'nome' => 'CHÁ REVELAÇÃO',
            'icone' => 'img/tree.png',
            'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'assinatura' => 'gratuito',
        ]);
        \App\Models\CategoriaEvento::factory()->create([
            'nome' => 'CHÁ DE FRALDAS',
            'icone' => 'img/tree.png',
            'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'assinatura' => 'gratuito',
        ]);
        \App\Models\CategoriaEvento::factory()->create([
            'nome' => 'CHÁ DE BEBÊ',
            'icone' => 'img/tree.png',
            'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'assinatura' => 'gratuito',
        ]);
        \App\Models\CategoriaEvento::factory()->create([
            'nome' => 'Lorem ipsum',
            'icone' => 'img/tree.png',
            'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'assinatura' => 'gratuito',
        ]);
        \App\Models\CategoriaEvento::factory()->create([
            'nome' => 'Categoria Premium',
            'icone' => 'img/tree.png',
            'descricao' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'assinatura' => 'premium',
        ]);

        $evento = \App\Models\Evento::factory()->create([
            'user_id' => $usuario->id,
            'link_pagina' => 'teste',
            'titulo' => 'Landing page para testes',
            'categoria_evento_id' => $categoriaEvento->id
        ]);

        \App\Models\Evento::factory(10)->create([
            'user_id' => $usuario->id,
            'categoria_evento_id' => $categoriaEvento->id
        ]);

        $cat1 = \App\Models\CategoriaPresente::factory()->create([
            'nome' => 'Brinquedos',
            'user_id' => $usuario->id,
            'evento_id' => $evento->id,
        ]);
        $cat2 = \App\Models\CategoriaPresente::factory()->create([
            'nome' => 'Livros',
            'user_id' => $usuario->id,
            'evento_id' => $evento->id,
        ]);
        $cat3 = \App\Models\CategoriaPresente::factory()->create([
            'nome' => 'Higiene',
            'user_id' => $usuario->id,
            'evento_id' => $evento->id,
        ]);

        \App\Models\Presente::factory(6)->create([
            'categoria_presente_id' => $cat1
        ]);
        \App\Models\Presente::factory(6)->create([
            'categoria_presente_id' => $cat2
        ]);
        \App\Models\Presente::factory(6)->create([
            'categoria_presente_id' => $cat3
        ]);

        \App\Models\PixUsuario::factory()->create([
            'user_id' => $usuario->id,
            'tipo_chave' => 'Celular',
            'chave' => '(99) 99999-9999',
            'valor' => 20.00,
            'qrcode' => 'img/qrcode.png'
        ]);
    }
}
