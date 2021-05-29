<?php
namespace Tests\Routes;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class RouteLojistaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create route
     *
     * @test
     */
    public function route_lojistas()
    {
        $pessoa = \App\Models\Pessoa::factory()->create();
       $data = [
           "nome" => "Dr Rocio Homenick Jr",
           "email" => "olinratkess@gmailcom",
           "cpf_cnpj" => "68999340007", //cpf para teste adiquirido no site https://www.4devs.com.br/gerador_de_cpf
           "senha" => "srsahroaiusra",
           "tipo_pessoa_id" => 2
       ];
        $this->post(env('APP_URL').'/lojista',$data);

        $this->assertDatabaseHas('pessoa', [
            "email" => "olinratkess@gmailcom",
            "cpf_cnpj" => "68999340007"
        ]);
    }

    /**
     * Validates the payload
     * - log: should be required
     * - day : should be required and have a valid date
     *
     * @test
     */
    public function validate_the_payload()
    {
        Artisan::call("db:seed");
        $this->postJson(env('APP_URL').'/lojista')
            ->assertJsonValidationErrors([
                'cpf_cnpj' => __('validation.required', ['attribute' => 'cpf cnpj']),
                'nome' => __('validation.required', ['attribute' => 'nome']),
                'email' => __('validation.required', ['attribute' => 'email']),
                'senha' => __('validation.required', ['attribute' => 'senha'])
            ]);

        $this->postJson(env('APP_URL').'/lojista', ['email' => 'email_invalid'])
            ->assertJsonValidationErrors([
                'email' => __('validation.email', ['attribute' => 'email']),
            ]);



        $data = [
            "nome" => "Dr Rocio Homenick Jr",
            "email" => "olinratkess@gmailcom",
            "cpf_cnpj" => "68999340007", //cpf para teste adiquirido no site https://www.4devs.com.br/gerador_de_cpf
            "senha" => "srsahroaiusra",
            "tipo_pessoa_id" => 2
        ];

        $this->postJson(env('APP_URL').'/lojista', $data);

        $this->postJson(env('APP_URL').'/lojista', $data)
            ->assertJsonValidationErrors([
                'cpf_cnpj' => __('validation.unique', ['attribute' => 'cpf cnpj']),
            ]);
        $data['cpf_cnpj'] = "90241325099"; //cpf para teste adiquirido no site https://www.4devs.com.br/gerador_de_cpf
        $this->postJson(env('APP_URL').'/lojista', $data)
            ->assertJsonValidationErrors([
                'email' => __('validation.unique', ['attribute' => 'email']),
            ]);

    }


}
