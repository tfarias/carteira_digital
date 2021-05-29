<?php

namespace App\Repositories;

use App\Models\Movimento;
use App\Services\AutorizaServices;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MovimentoRepositoryEloquent extends BaseRepository implements MovimentoRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Movimento::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function transferir(array $dados){
        $carteira = auth()->user()->carteira();
        $dados['carteira_origen'] = $carteira->id;
        return $this->create($dados);
    }

    public function create(array $attributes)
    {
        $autorizaServices = app(AutorizaServices::class);
        DB::beginTransaction();
        try{
            //se a carteira de destino estiver vazia então estou adicionando saldo a minha carteira
            $attributes['carteira_destino'] = empty($attributes['carteira_destino']) ? auth()->user()->carteira()->id : $attributes['carteira_destino'];
            $attributes['status'] = $autorizaServices->autorizar()->message;
            $movimento = parent::create($attributes);
            //caso não ocorra nenhum erro no cadastro do movimento e da evento de atualizar a carteira finalizo a transação
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            $attributes['status'] = $e->getMessage();
            $movimento = parent::create($attributes);
        }

       return [
           'valor' => $movimento->valor,
           'origen' => $movimento->carteira_origen,
           'destino' => $movimento->carteira_destino,
           'status' => $movimento->status
       ];
    }


}
