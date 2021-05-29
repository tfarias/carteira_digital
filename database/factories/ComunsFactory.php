<?php

namespace Database\Factories;

use App\Models\Comuns;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Artisan;

class ComunsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comuns::class;

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
            'tipo_pessoa_id' => 1,

        ];
    }
}
