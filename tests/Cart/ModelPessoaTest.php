<?php

namespace Tests\Cart;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Models Test
 * @package Tests\Feature\Cart
 */
class ModelPessoaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create Pessoa Model
     *
     * @test
     */
    public function create_a_model()
    {
        $this->assertTrue(class_exists('App\Models\Pessoa'));
    }

    /**
     * Create relationships between Pessoa and TipoPessoa
     *
     * @test
     */
    public function relationship_with_the_pessoa_and_tipo_pessoa()
    {
        $pessoa     = new \App\Models\Pessoa();
        $relationship = $pessoa->tipoPessoa();

        $this->assertEquals(BelongsTo::class, get_class($relationship), 'pessoa->tipoPessoa()');

    }

    /**
     * Create factories for Pessoa
     *
     * @test
     */
    public function create_factories()
    {
        \App\Models\Pessoa::factory()->create();
        $this->assertCount(1, \App\Models\Pessoa::all());
    }


    /**
     * Create a get mutator on Pessoa's model to transform
     * the return from uppercase nome example: "tiago farias" to "Tiago Farias"
     *
     * @test
     */
    public function use_get_mutator()
    {
        $pessoa = \App\Models\Pessoa::factory()->make();
        $pessoa->nome = 'tiago farias';
        $this->assertEquals('Tiago Farias', $pessoa->nome);
    }

    /**
     *
     * @test
     */
    public function create_carteira_after_create_pessoa()
    {
        $pessoa = \App\Models\Pessoa::factory()->create();
        $this->assertDatabaseHas('carteira', [
            "pessoa_id" => $pessoa->id
        ]);
    }
}
