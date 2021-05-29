<?php

namespace App\Models;

use App\Models\Pessoa;
use App\Models\Traits\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carteira extends Model
{
    use HasFactory, SoftDeletes, Currency;
    protected $table = "carteira";
    protected $dates = ['deleted_at'];


    protected $fillable = [
        'pessoa_id',
        'saldo',
    ];

    public function pessoa(){
        return $this->belongsTo(Pessoa::class);
    }

    public function movimentos()
    {
        return $this->hasMany(Movimento::class);
    }

    public function setSaldoAttribute($saldo){
        $this->attributes['saldo'] = Currency::get_amount($saldo);
    }
}
