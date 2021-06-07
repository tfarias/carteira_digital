<?php

namespace App\Listeners;

use App\Events\MovimentoCarteira;

class CreateJobMovimento
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param MovimentoCarteira $movimentoCarteira
     * @return void
     */
    public function handle(MovimentoCarteira $movimentoCarteira)
    {
        $movimento = $movimentoCarteira->movimento;
        if ($movimento->status === 'Autorizado') {
            \App\Jobs\MovimentoJob::dispatch($movimentoCarteira->movimento);
        }
    }
}
