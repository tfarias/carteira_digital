<?php

namespace App\Policies;

use App\Exceptions\PolicyException;
use App\Models\Pessoa;
use Illuminate\Auth\Access\HandlesAuthorization;

class AutorizadorPolicy
{
    use HandlesAuthorization;

    /**
     * @throws PolicyException
     */
    public function transferir(Pessoa $pessoa){
        if($pessoa->tipo_pessoa_id !== 1){
           throw new PolicyException("Lojista não pode fazer transferências");
        }
    }

    /**
     * @throws PolicyException
     */
    public function comun(Pessoa $pessoa){
        if($pessoa->tipo_pessoa_id !== 1){
            throw new PolicyException("This action is unauthorized.");
        }
    }

    /**
     * @throws PolicyException
     */
    public function lojista(Pessoa $pessoa){
        if($pessoa->tipo_pessoa_id !== 2){
            throw new PolicyException("This action is unauthorized.");
        }
    }

}
