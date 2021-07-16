<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
class Notificacao extends Model
{
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $table = "notificacao";

    protected $fillable = [
       'id',
       'pessoa_origen',
       'pessoa_destino',
       'mensagem'
    ];

    protected $dates = ['deleted_at'];

}
