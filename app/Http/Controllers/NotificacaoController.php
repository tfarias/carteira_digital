<?php

namespace App\Http\Controllers;

use App\Criteria\NotificacoesCriteria;
use App\Repositories\NotificacaoRepository;

class NotificacaoController extends Controller
{
    /**
     * @var NotificacaoRepository
     */
    private $notificacaoRepository;

    /**
     * NotificacaoController constructor.
     */
    public function __construct(NotificacaoRepository $notificacaoRepository)
    {
        $this->notificacaoRepository = $notificacaoRepository;
    }

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function index(){
        $this->notificacaoRepository->pushCriteria(new NotificacoesCriteria);
        return $this->notificacaoRepository->all();
    }
}
