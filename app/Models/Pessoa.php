<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
/**
 * @property int $id
 * @property string $nome
 * @property string $cpf_cnpj
 * @property string $senha
 * @property string $email
 * @property int $tipo_pessoa_id
 */
class Pessoa extends Authenticatable  implements JWTSubject
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = "pessoa";
    protected $dates = ['deleted_at'];

    protected $hidden = [
        'senha'
    ];

    protected $fillable = [
        'nome',
        'email',
        'cpf_cnpj',
        'senha',
        'tipo_pessoa_id',
    ];


    protected $dispatchesEvents = [
        'created' => \App\Events\PessoaCreated::class,
    ];

    public function tipoPessoa(){
        return $this->belongsTo(TipoPessoa::class);
    }

    protected function getNomeAttribute(){
        return ucwords($this->attributes['nome']);
    }

    /**
     *
     * @SuppressWarnings(PHPMD)
     */
    protected function setSenhaAttribute($password){
        return $this->attributes['senha'] = Hash::make($password);
    }

    protected function getPasswordAttribute(){
        return $this->senha;
    }

    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function setTipoPessoaIdAttribute($tipo){
        $this->attributes['tipo_pessoa_id'] = $tipo;
    }

    public function carteira(){
        return $this->hasMany(Carteira::class,'pessoa_id','id')->first();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'user' => [
                'id' => $this->id,
                'nome' => $this->nome,
                'email' => $this->email,
                'cpf_cnpj' => $this->cpf_cnpj
            ]
        ];
    }
}
