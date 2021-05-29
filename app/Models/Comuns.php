<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comuns extends Pessoa
{
    use HasFactory;

    protected $attributes = [
        'tipo_pessoa_id' => 1
    ];
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(function ($query) {
            $query->where('tipo_pessoa_id', 1);
        });
    }

    public function setTipoPessoaIdAttribute($tipo){
        $this->attributes['tipo_pessoa_id'] = 1;
    }
}
