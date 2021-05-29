<?php

namespace App\Models;

use App\Models\Traits\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movimento extends Model
{
    use HasFactory,SoftDeletes , Currency;

    protected $table = "movimento";

    protected $fillable = [
        'carteira_origen',
        'valor',
        'status',
        'carteira_destino',
        'notificou'
    ];
    protected $dates = ['deleted_at'];

    protected $dispatchesEvents = [
        'created' => \App\Events\MovimentoCarteira::class,
    ];

    public function setValorAttribute($valor){
        $this->attributes['valor'] = Currency::get_amount($valor);
    }

    public function origen(){
        return $this->belongsTo(Carteira::class,'carteira_origen','id');
    }

    public function destino(){
        return $this->belongsTo(Carteira::class,'carteira_destino','id');
    }


}
