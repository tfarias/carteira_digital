<?php

namespace Database\Factories;

use App\Models\Comuns;
use App\Models\Lojistas;
use App\Models\Movimento;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovimentoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movimento::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'carteira_origen' => Comuns::factory()->create(),
            'valor' => $this->faker->randomFloat(),
            'status' => $this->faker->firstName,
            'carteira_destino' => Lojistas::factory()->create(),
            'notificou' => 'N'
        ];
    }
}
