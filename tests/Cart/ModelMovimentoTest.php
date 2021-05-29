<?php

namespace Tests\Cart;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Models Test
 * @package Tests\Feature\Cart
 */
class ModelMovimentoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create Movimento Model
     *
     * @test
     */
    public function create_a_model()
    {
        $this->assertTrue(class_exists('App\Models\Movimento'));
    }


    /**
     * Create relationships between Movimento and Carteira Origen
     *
     * @test
     */
    public function relationship_with_the_movimento_and_carteira_origen()
    {
        $movimento     = new \App\Models\Movimento();
        $relationship = $movimento->origen();

        $this->assertEquals(BelongsTo::class, get_class($relationship), 'movimento->origen()');

    }
    /**
     * Create relationships between Movimento and Carteira Destino
     *
     * @test
     */
    public function relationship_with_the_movimento_and_carteira_destino()
    {
        $movimento     = new \App\Models\Movimento();
        $relationship = $movimento->destino();

        $this->assertEquals(BelongsTo::class, get_class($relationship), 'movimento->destino()');

    }



    /**
     * Create factories for Movimento
     *
     * @test
     */
    public function create_factories()
    {
        \App\Models\Movimento::factory()->create();
        $this->assertCount(1, \App\Models\Movimento::all());
    }

    /**
     *
     * service notifies
     *
     * @test
     */
    public function status_service_when_add_saldo()
    {
        $notificacaoService = app(\App\Services\ChecaServicoService::class);
        $result = $notificacaoService->checar();

        $this->assertArrayHasKey('message',(array)$result,"result['message']");
    }

    /**
     *
     * service autorizacao
     *
     * @test
     */
    public function status_autorizacao_service()
    {
        $autorizaService = app(\App\Services\AutorizaServices::class);
        $result = $autorizaService->autorizar();

        $this->assertArrayHasKey('message',(array)$result,"result['message']");
    }



}
