<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Cliente::class;

    //protected $fillable = ['nome', 'email', 'cpf', 'sexo', 'endereco', 'numerocasa', 'cep', 'uf'];

    public function definition()
    {

        

        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cpf' => $this->faker->cpf(false),
            'sexo' => $this->faker->numberBetween(0,2),
            'endereco' => $this->faker->streetName,
            'numerocasa' => $this->faker->numberBetween(1,1000),
            'cep' => $this->faker->numberBetween(10000000,40000000),
            'uf' => $this->faker->stateAbbr,
        ];
    }
}

