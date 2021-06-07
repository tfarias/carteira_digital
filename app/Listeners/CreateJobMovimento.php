<?php

namespace App\Listeners;

use App\Events\MovimentoCarteira;
/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */
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
