<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paciente;
use App\Models\Medico;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    protected $model = Paciente::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->firstName,
            'sobrenome' => $this->faker->lastName,
            'cpf' => $this->faker->numerify('###.###.###-##'),
            'data_nascimento' => $this->faker->date('Y-m-d'),
            'idade' => $this->faker->numberBetween(1, 100),
            'sexo' => $this->faker->randomElement(['Masculino', 'Feminino']),
            'profissao' => $this->faker->jobTitle,
            'rg' => $this->faker->numerify('#########'),
            'email' => $this->faker->unique()->safeEmail,
            'telefone' => $this->faker->numerify('(##) #####-####'),
            'celular' => $this->faker->numerify('(##) #####-####'),
            'cep' => $this->faker->numerify('#####-###'),
            'estado' => $this->faker->stateAbbr,
            'cidade' => $this->faker->city,
            'bairro' => $this->faker->streetName,
            'rua' => $this->faker->streetAddress,
            'numero_residencial' => $this->faker->buildingNumber,
            'informacoes_medicas' => $this->faker->text,
            'medicos_id' => Medico::factory(),
        ];
    }
}
