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
class ModelComunsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create Comuns Model
     *
     * @test
     */
    public function create_a_model()
    {
        $this->assertTrue(class_exists('App\Models\Comuns'));
    }

    /**
     * Create relationships between Comuns and TipoPessoa
     *
     * @test
     */
    public function relationship_with_the_comuns_and_tipo_pessoa()
    {
        $comuns     = new \App\Models\Comuns();
        $relationship = $comuns->tipoPessoa();

        $this->assertEquals(BelongsTo::class, get_class($relationship), 'comuns->tipoPessoa()');

    }

    /**
     * Implement Model Query Scope to filter Comuns for tipoPessoa
     *
     * @test
     */
    public function implement_query_scope()
    {
         \App\Models\Pessoa::factory()->count(2)->create(['tipo_pessoa_id'=>1]);
         \App\Models\Pessoa::factory()->count(3)->create(['tipo_pessoa_id'=>2]);
        $comuns = \App\Models\Comuns::get();

        $this->assertCount(2, $comuns);
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
        $lojista = \App\Models\Comuns::create([
            "nome" => "Dr Rocio Homendsdick Jr",
            "email" => "olin.ratkesdsds@example.org",
            "cpf_cnpj" => "18807417635",
            "senha" => "srsahroadsdiusra",
            "tipo_pessoa_id" => 2
        ]);
        $this->assertEquals(1, $lojista->tipo_pessoa_id);
    }

}
