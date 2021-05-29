<?php

namespace App\Listeners;

use App\Events\PessoaCreated;
use App\Repositories\CarteiraRepository;

class CreateCarteiraListener
{
    /**
     * @var CarteiraRepository
     */
    private $carteiraRepository;

    /**
     * CreateCarteiraListener constructor.
     */
    public function __construct(CarteiraRepository $carteiraRepository)
    {
        $this->carteiraRepository = $carteiraRepository;
    }


    /**
     * Handle the event.
     *
     * @param  PessoaCreated  $event
     * @return void
     */
    public function handle(PessoaCreated $pessoaCreated)
    {
        $this->carteiraRepository->create([
            'pessoa_id' => $pessoaCreated->pessoa->id,
            'saldo' => 0
        ]);
    }
}
