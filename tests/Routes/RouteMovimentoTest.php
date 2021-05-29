<?php
namespace Tests\Routes;

use App\Models\Comuns;
use App\Models\Lojistas;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class RouteMovimentoTest extends TestCase
{
    use RefreshDatabase;

    private $password = 'some-password';

    public function actingAsUser($user)
    {
        $token = auth('api')->attempt([
            'email' => $user->email,
            'password' => $this->password
        ]);

        $this->withHeaders(['Authorization' => 'Bearer ' . $token]);

        return $this;
    }

    /**
     * Create route
     *
     * @test
     */
    public function route_movimento()
    {
       Artisan::call('db:seed');
       $comun = Comuns::factory()->create([
           'senha'=>$this->password
       ]);

      $this->actingAsUser($comun);
        $this->post(env('APP_URL').'/movimento',['valor' => 100.0]);
        $this->assertDatabaseHas('movimento', [
            "carteira_destino" => $comun->id
        ]);

        $this->assertDatabaseHas('carteira', [
            "pessoa_id" => $comun->id,
            "saldo" => 100.0
        ]);
    }

    /**
     * Validates the payload
     *
     * @test
     */
    public function validate_the_payload()
    {
        $comun = Comuns::factory()->create([
            'senha'=>$this->password
        ]);
        $this->actingAsUser($comun)
            ->postJson(env('APP_URL').'/movimento/transferir')
            ->assertJsonValidationErrors([
                'valor' => __('validation.required', ['attribute' => 'valor']),
                'carteira_destino' => __('validation.required', ['attribute' => 'carteira destino']),
            ]);
    }


    /**
     * validates if you have a balance
     *
     * @test
     */
    public function validate_saldo()
    {
        $comun = Comuns::factory()->create([
            'senha'=>$this->password
        ]);

        $lojista = Lojistas::factory()->create();


        $response = $this->actingAsUser($comun)
            ->postJson(env('APP_URL').'/movimento/transferir',[
                'carteira_destino' => $lojista->carteira()->id,
                'valor' => 50.00
            ]);
        $this->assertArrayHasKey('valor',$response->json()['errors']);

    }

    /**
     * test if the lojista can move
     *
     * @test
     */
    public function use_policy_to_authorize_movimento()
    {
        $pessoa1 = Comuns::factory()->create([
            'senha'=>$this->password
        ]);
        $pessoa2 = Lojistas::factory()->create([
            'senha'=>$this->password
        ]);

        $carteira = $pessoa2->carteira();
        $carteira->saldo = 100.0;
        $carteira->save();


        $this->actingAsUser($pessoa2)
            ->postJson(env('APP_URL').'/movimento/transferir', [
                'carteira_destino' => $pessoa1->carteira()->id,
                'valor' => 50.00
            ])
            ->assertForbidden();
    }
}
