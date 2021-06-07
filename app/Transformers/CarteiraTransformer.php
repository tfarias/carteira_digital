<?php

namespace App\Transformers;

use App\Models\Carteira;
use League\Fractal\TransformerAbstract;

/**
 * Class VendaTransformer.
 *
 * @package namespace App\Transformers;
 */
class CarteiraTransformer extends TransformerAbstract
{

    public function transform(Carteira $model)
    {
        return [
            'id'         => (int) $model->id,
            'pessoa_id'  => $model->pessoa_id,
            'saldo'      => $model->saldo,
            'pessoa'     => [
                        'id' => $model->pessoa->id,
                        'nome' => $model->pessoa->nome,
                        'email' => $model->pessoa->email,
                        'cpf_cnpj' => $model->pessoa->cpf_cnpj,
                        'tipo_pessoa' => $model->pessoa->tipoPessoa->descricao,
                ]
        ];
    }
}
