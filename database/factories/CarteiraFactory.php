<?php

namespace Database\Factories;

use App\Models\Carteira;
use App\Models\Pessoa;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarteiraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carteira::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pessoa_id' => Pessoa::factory()->create(),
            'saldo' => $this->faker->randomFloat()
        ];
    }
}
