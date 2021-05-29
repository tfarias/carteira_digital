<?php

namespace Tests\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Models Test
 * @package Tests\Feature\Cart
 */
class ModelNotificacaoTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Create Notificacao Model
     *
     * @test
     */
    public function create_a_model()
    {
        $this->assertTrue(class_exists('App\Models\Notificacao'));
    }

    /**
     * Check if connection notificacao is mongodb
     *
     * @test
     */
    public function notificacao_connection_mongodb()
    {
        $notificacao     = new \App\Models\Notificacao();

        $this->assertEquals('mongodb', $notificacao->getConnectionName(), 'notificacao->getConnectionName()');
    }
}
