<?php

namespace Tests\Cart;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/**
 * Models Test
 * @package Tests\Feature\Cart
 */
class ModelLojistaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create Comuns Model
     *
     * @test
     */
    public function create_a_model()
    {
        $this->assertTrue(class_exists('App\Models\Lojistas'));
    }

    /**
     * Create relationships between Logistas and TipoPessoa
     *
     * @test
     */
    public function relationship_with_the_logistas_and_tipo_pessoa()
    {
        $logistas     = new \App\Models\Lojistas();
        $relationship = $logistas->tipoPessoa();

        $this->assertEquals(BelongsTo::class, get_class($relationship), 'logistas->tipoPessoa()');

    }

    /**
     * Implement Model Query Scope to filter Logistas for tipoPessoa
     *
     * @test
     */
    public function implement_query_scope()
    {
         \App\Models\Pessoa::factory()->count(2)->create(['tipo_pessoa_id'=>1]);
         \App\Models\Pessoa::factory()->count(3)->create(['tipo_pessoa_id'=>2]);
        $lojistas = \App\Models\Lojistas::get();

        $this->assertCount(3, $lojistas);
    }


    /**
     * Create a set mutator on Pessoa's model to transform
     * the password to a hash string when setting the password
     *
     * @test
     */
    public function use_set_mutator()
    {
        Artisan::call('db:seed');
        $lojista = \App\Models\Lojistas::create([
            "nome" => "Dr Rocio Homenick Jr",
            "email" => "olin.ratkess@example.org",
            "cpf_cnpj" => "+1-880-741-7635",
            "senha" => "srsahroaiusra",
            "tipo_pessoa_id" => 1
        ]);
        $this->assertEquals(2, $lojista->tipo_pessoa_id);
    }


}
