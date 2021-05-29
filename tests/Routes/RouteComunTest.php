<?php
namespace Tests\Routes;

use App\Models\Comuns;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class RouteComunTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create route
     *
     * @test
     */
    public function route_comun()
    {
       $data = Comuns::factory()->make()->toArray();
       $data['senha'] = "121312321";
       $data['cpf_cnpj'] = "22258578060";

        $this->post('/comun',$data);

        $this->assertDatabaseHas('pessoa', [
            "email" => $data['email'],
            "cpf_cnpj" => $data['cpf_cnpj']
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
        $this->postJson('/comun')
            ->assertJsonValidationErrors([
                'cpf_cnpj' => __('validation.required', ['attribute' => 'cpf cnpj']),
                'nome' => __('validation.required', ['attribute' => 'nome']),
                'email' => __('validation.required', ['attribute' => 'email']),
                'senha' => __('validation.required', ['attribute' => 'senha'])
            ]);


        $this->postJson(env('APP_URL').'/comun', ['email' => 'email_invalid'])
            ->assertJsonValidationErrors([
                'email' => __('validation.email', ['attribute' => 'email']),
            ]);

        $data = [
            "nome" => "Dr Rocio Homenick Jr",
            "email" => "olinratkess@gmailcom",
            "cpf_cnpj" => "68999340007", //cpf para teste adiquirido no site https://www.4devs.com.br/gerador_de_cpf
            "senha" => "srsahroaiusra",
            "tipo_pessoa_id" => 1
        ];

        $this->postJson(env('APP_URL').'/comun', $data);

        $this->postJson(env('APP_URL').'/comun', $data)
            ->assertJsonValidationErrors([
                'cpf_cnpj' => __('validation.unique', ['attribute' => 'cpf cnpj']),
            ]);

        $data['cpf_cnpj'] = "90241325099"; //cpf para teste adiquirido no site https://www.4devs.com.br/gerador_de_cpf
        $this->postJson(env('APP_URL').'/comun', $data)
            ->assertJsonValidationErrors([
                'email' => __('validation.unique', ['attribute' => 'email']),
            ]);

    }


}
