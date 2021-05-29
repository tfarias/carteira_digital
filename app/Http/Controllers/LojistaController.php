<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa;
use App\Repositories\LojistaRepository;


class LojistaController extends Controller
{
    /**
     * @var LojistaRepository
     */
    private $lojistaRepository;

    /**
     * LojistaController constructor.
     */
    public function __construct(LojistaRepository $lojistaRepository)
    {
        $this->lojistaRepository = $lojistaRepository;
    }

    public function store(PessoaRequest $request){
        return $this->lojistaRepository->create($request->all());
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(PessoaRequest $request){
        $this->authorize('update_lojista', Pessoa::class);
        return $this->lojistaRepository->update($request->all(), auth()->user()->id);
    }

}
