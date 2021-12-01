<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Produto::class;
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'marca' => $this->faker->company(),
            'descricao' => $this->faker->text(),
            'preco' => $this->faker->numberBetween(0,10000),
            'estoque' => $this->faker->numberBetween(0,10000)
            
        ];
    }
    

}