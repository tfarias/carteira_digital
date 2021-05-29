<?php

namespace Tests\Cart;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/**
 * Models Test
 * @package Tests\Feature\Cart
 */
class ModelTipoPessoaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Create TipoPessoa Model
     *
     * @test
     */
    public function create_a_model()
    {
        $this->assertTrue(class_exists('App\Models\TipoPessoa'));
    }

    /**
     * Create relationships between TipoPessoa and Pessoa
     *
     * @test
     */
    public function relationship_with_the_tipo_pessoa_and_pessoa()
    {
        $tipoPessoa     = new \App\Models\TipoPessoa();
        $relationship = $tipoPessoa->pessoas();

        $this->assertEquals(HasMany::class, get_class($relationship), 'tipoPessoa->pessoas()');
    }

    /**
     * Create TipoPessoa Seeder
     *
     * @test
     */
    public function create_a_seeder()
    {
        $this->assertTrue(class_exists('Database\Seeders\TipoPessoaSeeder'));
    }

    /**
     * TipoPessoa Seeder
     *
     * @test
     */
    public function check_if_seeder_two_types()
    {
        Artisan::call('db:seed');
        $tipoPessoa = \App\Models\TipoPessoa::all();
        $this->assertCount(2, $tipoPessoa);
    }

    /**
     * TipoPessoa Seeder
     *
     * @test
     */
    public function check_if_seeder_id_one_is_comuns()
    {
        Artisan::call('db:seed');
        $tipoPessoa = \App\Models\TipoPessoa::where('id',1)->first();
        $this->assertEquals('Comuns', $tipoPessoa->descricao);
    }

}
