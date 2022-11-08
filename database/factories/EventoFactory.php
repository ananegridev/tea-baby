<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mes_gestacao' => date('Y-m', strtotime("+ " . rand(3, 7) . "months")),
            'sexo_bebe' => $this->faker->randomElement(['Masculino', 'Feminino']),
            'data_evento' => date('Y-m-d', strtotime("+ " . rand(30, 40) . "days")),
            'nome_baby' => $this->faker->name(),
            'link_pagina' => Str::slug($this->faker->sentence(2)),
            'titulo' => $this->faker->sentence(4),
            'sobre' => $this->faker->sentence(50),
            'celular' => '(99) 99999-9999',
            'cep' => '99999-999',
            'endereco' => $this->faker->sentence(2),
            'numero_endereco' => rand(100, 1000),
            'complemento' => $this->faker->sentence(2),
            'cidade' => $this->faker->sentence(1),
            'estado' => $this->faker->sentence(1),
            'ponto_referencia' => $this->faker->sentence(2),
            'user_id' => 2,
        ];
    }
}
