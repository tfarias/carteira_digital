<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa;
use App\Repositories\ComunRepository;


class ComunController extends Controller
{
    /**
     * @var ComunRepository
     */
    private $comunRepository;

    /**
     * ComunController constructor.
     */
    public function __construct(ComunRepository $comunRepository)
    {
        $this->comunRepository = $comunRepository;
    }

    public function store(PessoaRequest $request){
        return $this->comunRepository->create($request->all());
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(PessoaRequest $request){
        $this->authorize('update_comun', Pessoa::class);
        return $this->comunRepository->update($request->all(), auth()->user()->id);
    }


}
