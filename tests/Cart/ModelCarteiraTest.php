<?php

namespace Tests\Cart;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Models Test
 * @package Tests\Feature\Cart
 */
class ModelCarteiraTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create Carteira Model
     *
     * @test
     */
    public function create_a_model()
    {
        $this->assertTrue(class_exists('App\Models\Carteira'));
    }

    /**
     * Create relationships between Carteira and Pessoa
     *
     * @test
     */
    public function relationship_with_the_carteira_and_pessoa()
    {
        $carteira     = new \App\Models\Carteira();
        $relationship = $carteira->pessoa();

        $this->assertEquals(BelongsTo::class, get_class($relationship), 'carteira->pessoa()');

    }

    /**
     * Create relationships between Carteira and Movimento
     *
     * @test
     */
    public function relationship_with_the_carteira_and_movimento()
    {

        $carteira     = new \App\Models\Carteira();
        $relationship = $carteira->movimentos();

        $this->assertEquals(HasMany::class, get_class($relationship), 'carteira->movimentos()');
    }

    /**
     * Create factories for Carteira
     *
     * @test
     */
    public function create_factories()
    {
        $pessoa = \App\Models\Pessoa::factory()->create();
        $this->assertIsInt($pessoa->carteira()->id,'pessoa->carteira()');

    }

    /**
     * Create a get saldo on Carteira model to transform
     *
     * @test
     */
    public function use_get_mutator()
    {
        $carteira = \App\Models\Carteira::factory()->make();
        $carteira->saldo = '100,00';
        $this->assertEquals(100.0, $carteira->saldo);
    }

}
