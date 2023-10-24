<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Medico;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medico>
 */
class MedicoFactory extends Factory
{
    protected $model = Medico::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'aprovado' => $this->faker->boolean,
            'crm' => $this->faker->numerify('##########'),
            'especialidade' => $this->faker->jobTitle,
            'cpf' => $this->faker->numerify('###.###.###-##'),
            'rg' => $this->faker->numerify('#########'),
            'data_nascimento' => $this->faker->date('Y-m-d'),
            'telefone' => $this->faker->numerify('(##) #####-####'),
            'celular' => $this->faker->numerify('(##) #####-####'),
            'cep' => $this->faker->numerify('#####-###'),
            'estado' => $this->faker->stateAbbr,
            'cidade' => $this->faker->city,
            'bairro' => $this->faker->streetName,
            'rua' => $this->faker->streetAddress,
            'numero' => $this->faker->buildingNumber,
        ];
    }
}
