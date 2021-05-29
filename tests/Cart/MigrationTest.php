<?php

namespace Tests\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Migration Test
 * - On this test we will check if you know how to:
 *
 * 1. Create migration
 * 2. Setup Columns
 * 3. Create Relationships and Indexes
 *
 * @package Tests\Feature\Cart
 */
class MigrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create tipo_pessoa table
     *
     * @test
    */
    public function create_tipo_pessoa_table()
    {
        $this->assertTrue(
            Schema::hasTable('tipo_pessoa')
        );
    }

    /**
     * @test
     */
    public function create_columns_tipo_pessoa()
    {
        $this->assertTrue(
            Schema::hasColumns('tipo_pessoa', [
                'id',
                'descricao',
                'created_at',
                'updated_at',
                'deleted_at'
            ])
        );
    }

    /**
     * Create pessoa table
     *
     * @test
     */
    public function create_pessoa_table()
    {
        $this->assertTrue(
            Schema::hasTable('pessoa')
        );
    }

    /**
     * @test
     */
    public function create_columns_pessoa()
    {
        $this->assertTrue(
            Schema::hasColumns('pessoa', [
                'id',
                'nome',
                'email',
                'cpf_cnpj',
                'senha',
                'tipo_pessoa_id',
                'created_at',
                'updated_at',
                'deleted_at'
            ])
        );
    }

    /**
     * Create carteira table
     *
     * @test
     */
    public function create_carteira_table()
    {
        $this->assertTrue(
            Schema::hasTable('carteira')
        );
    }

    /**
     * @test
     */
    public function create_columns_carteira()
    {
        $this->assertTrue(
            Schema::hasColumns('carteira', [
                'id',
                'pessoa_id',
                'saldo',
                'created_at',
                'updated_at',
                'deleted_at'
            ])
        );
    }


    /**
     * Create movimento table
     *
     * @test
     */
    public function create_movimento_table()
    {
        $this->assertTrue(
            Schema::hasTable('movimento')
        );
    }

    /**
     * @test
     */
    public function create_columns_movimento()
    {
        $this->assertTrue(
            Schema::hasColumns('movimento', [
                'id',
                'carteira_origen',
                'valor',
                'carteira_destino',
                'status',
                'notificou',
                'created_at',
                'updated_at',
                'deleted_at'
            ])
        );
    }


}
