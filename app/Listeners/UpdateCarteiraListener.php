<?php

namespace App\Listeners;

use App\Events\MovimentoCarteira;
use App\Repositories\CarteiraRepository;

class UpdateCarteiraListener
{
    /**
     * @var CarteiraRepository
     */
    private $carteiraRepository;

    /**
     * UpdateCarteiraListener constructor.
     */
    public function __construct(CarteiraRepository $carteiraRepository)
    {
        $this->carteiraRepository = $carteiraRepository;
    }


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(MovimentoCarteira $movimentoCarteira)
    {
            $movimento = $movimentoCarteira->movimento;
            if ($movimento->status === 'Autorizado') {
                if (!empty($movimento->carteira_origen)) {
                    $origen = $this->carteiraRepository->find($movimento->carteira_origen);
                    $saldo = $origen->saldo-=$movimento->valor;
                    $this->carteiraRepository->update([
                        'saldo' => $saldo
                    ],$origen->id);

                }
                $destino = $this->carteiraRepository->find($movimento->carteira_destino);
                $saldo = $destino->saldo+=$movimento->valor;
                $this->carteiraRepository->update([
                    'saldo' => $saldo
                ],$destino->id);
            }

    }
}
