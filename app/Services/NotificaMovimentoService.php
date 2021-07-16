<?php


namespace App\Services;


use App\Criteria\MovimentoNotificacoesCriteria;
use App\Models\Movimento;
use App\Repositories\MovimentoRepository;
use App\Repositories\NotificacaoRepository;
use Illuminate\Support\Facades\DB;

/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */
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
    private $notifyRepository;


    /**
     * NotificaMovimentoService constructor.
     */
    public function __construct(
        ChecaServicoService $checaServicoService,
        MovimentoRepository $movimentoRepository,
        NotificacaoRepository $notifyRepository
    )
    {
        $this->checaServicoService = $checaServicoService;
        $this->movimentoRepository = $movimentoRepository;
        $this->notifyRepository = $notifyRepository;
    }

    /**
     * @throws \Prettus\Repository\Exceptions\RepositoryException|\GuzzleHttp\Exception\GuzzleException
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


    /**
     * @param Movimento $movimento
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     */
    public function notifica($movimento){

        $result = $this->checaServicoService->checar();
        if($result->message=="Success"){
            $origen = $movimento->origen ? $movimento->origen->pessoa_id : null;
            DB::beginTransaction();
            try {
                $movimento->notificou = 'S';
                $movimento->save();
                $this->notifyRepository->create([
                    'pessoa_origen' => $origen,
                    'pessoa_destino' => $movimento->destino->pessoa_id,
                    'mensagem' => "A quantida de {$movimento->valor} foi adicionado a sua carteira!"
                ]);
                DB::commit();
            }catch (\Exception $e){
                DB::rollback();
            }
        }
    }


}
