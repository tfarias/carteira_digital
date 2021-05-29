<?php

namespace Database\Seeders;

use App\Models\TipoPessoa;
use Illuminate\Database\Seeder;

class TipoPessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pessoa = [
            [
                'id' => 1, 'descricao' => 'Comuns'
            ],
            [
                'id' => 2, 'descricao' => 'Lojistas'
            ]
        ];

        foreach ($pessoa as $p){
            $exists = TipoPessoa::where('id',$p['id'])->count();
            if($exists<=0){
                TipoPessoa::create($p);
            }
        }
    }
}
