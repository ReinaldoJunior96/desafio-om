<?php

namespace Database\Factories;

use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');
        return [
            'cep' => fake()->postcode,
            'endereco' => $faker->address,
            'numero' => fake()->numberBetween(1,100),
            'complemento' => 'Próximo a ' . $faker->company, // password
            'bairro' => $faker->cpf,
            'cidade' => $faker->city,
            'estado' => $faker->stateAbbr,
            'paciente_id' => Paciente::factory(),

        ];
    }
}
