<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdicionarSaldoRequest;
use App\Http\Requests\MovimentoRequest;
use App\Models\Pessoa;
use App\Repositories\MovimentoRepository;


class MovimentoController extends Controller
{
    /**
     * @var MovimentoRepository
     */
    private $movimentoRepository;

    /**
     * MovimentoController constructor.
     */
    public function __construct(MovimentoRepository $movimentoRepository)
    {
        $this->movimentoRepository = $movimentoRepository;
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function transferir(MovimentoRequest $request){
        $this->authorize('transferir', Pessoa::class);
        return $this->movimentoRepository->transferir($request->all());
    }

    public function store(AdicionarSaldoRequest $request){
        return $this->movimentoRepository->create($request->all());
    }
}
