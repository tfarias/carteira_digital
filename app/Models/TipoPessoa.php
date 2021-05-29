<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPessoa extends Model
{
    use SoftDeletes;

    protected $table = "tipo_pessoa";
    protected $fillable = [
        'descricao'
    ];
    protected $dates = ['deleted_at'];

    public function pessoas()
    {
        return $this->hasMany(Pessoa::class);
    }
}
