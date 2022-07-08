<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Carrera_UCR>
 */
class Carrera_UCRFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => '1',  
            'nombre'=> $this->faker->name,
            'coordinador'=> '5', 
            'telefono'=> '5', 
            'bloques'=> '5', 
            'creditos'=> '125',
        ];
    }
}
