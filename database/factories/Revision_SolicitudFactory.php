<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Revision_Solicitud>
 */
class Revision_SolicitudFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                'fecha'=>$this->faker->dateTime(),
                'estado' => $this->faker->randomElement(['Pendiente', 'Aprobado', 'Rechazado']),
                'solicitud_Numero' => $this->faker->numberBetween(1,100),
        ];
    }
}
