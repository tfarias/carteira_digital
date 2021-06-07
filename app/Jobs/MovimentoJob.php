<?php

namespace App\Jobs;

use App\Models\Movimento;
use App\Services\NotificaMovimentoService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */

class MovimentoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Movimento
     */
    private $movimento;

    /**
     * Create a new job instance.
     *
     * @param Movimento $movimento
     */
    public function __construct(Movimento $movimento)
    {
        $this->movimento = $movimento;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notificaMov = app(NotificaMovimentoService::class);
        $notificaMov->notifica($this->movimento);
    }
}
