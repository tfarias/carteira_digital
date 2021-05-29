<?php

namespace App\Models;

use App\Models\Pessoa;
use App\Models\Traits\Currency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @property int $id
 * @property int $pessoa_id
 * @property string|double|numeric $saldo
 */
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

    /**
     * @param string|double|numeric $saldo
     */
    protected function setSaldoAttribute($saldo){
        $this->attributes['saldo'] = self::getAmount($saldo);
    }
}
