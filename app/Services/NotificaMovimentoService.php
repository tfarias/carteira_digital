<?php


namespace App\Services;


use App\Criteria\MovimentoNotificacoesCriteria;
use App\Models\Notificacao;
use App\Repositories\MovimentoRepository;
use App\Repositories\NotificacaoRepository;
use Illuminate\Support\Facades\DB;

class NotificaMovimentoService
{
    /**
     * @var ChecaServicoService
     */
    private $checaServicoService;
    /**
     * @var MovimentoRepository
     */
    private $movimentoRepository;
    /**
     * @var NotificacaoRepository
     */
    private $notificacaoRepository;

    /**
     * NotificaMovimentoService constructor.
     */
    public function __construct(
        ChecaServicoService $checaServicoService,
        MovimentoRepository $movimentoRepository,
        NotificacaoRepository $notificacaoRepository
    )
    {
        $this->checaServicoService = $checaServicoService;
        $this->movimentoRepository = $movimentoRepository;
        $this->notificacaoRepository = $notificacaoRepository;
    }

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function init(){
        $this->movimentoRepository->pushCriteria(new MovimentoNotificacoesCriteria);
        $movimentos = $this->movimentoRepository->all();

        if($movimentos->isNotEmpty()) {
            $movimentos->each(function ($m) {
                $this->notifica($m);
            });
        }
    }

    public function notifica($movimento){
        $result = $this->checaServicoService->checar();
        if($result->message=="Success"){
            DB::beginTransaction();
            try {
                $movimento->notificou = 'S';
                $movimento->save();
                $this->notificacaoRepository->create([
                    'pessoa_id' => $movimento->destino->pessoa_id,
                    'mensagem' => "A quantida de {$movimento->valor} foi adicionado a sua carteira!"
                ]);
                DB::commit();
            }catch (\Exception $e){
                DB::rollback();
            }
        }
    }


}
