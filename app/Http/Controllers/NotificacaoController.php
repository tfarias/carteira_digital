<?php

namespace App\Http\Controllers;

use App\Criteria\NotificacoesCriteria;
use App\Repositories\NotificacaoRepository;

class NotificacaoController extends Controller
{
    /**
     * @var NotificacaoRepository
     */
    private $repository;

    /**
     * NotificacaoController constructor.
     */
    public function __construct(NotificacaoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(){
        $this->repository->pushCriteria(new NotificacoesCriteria);
        return $this->repository->all();
    }

    /**
     * @return mixed
     */
    public function all(){
        return $this->repository->all();
    }
}
