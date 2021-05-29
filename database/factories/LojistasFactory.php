<?php

namespace Database\Factories;

use App\Models\Lojistas;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Artisan;

class LojistasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lojistas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Artisan::call('db:seed');
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cpf_cnpj' => $this->faker->phoneNumber,
            'senha' => '123456', // password
            'tipo_pessoa_id' => 2,

        ];
    }
}
