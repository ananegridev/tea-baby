<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PresenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => ucfirst($this->faker->word()),
            'total' => rand(1,5),
        ];
    }
}
