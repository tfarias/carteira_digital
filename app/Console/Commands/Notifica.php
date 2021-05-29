<?php

namespace App\Console\Commands;

use App\Services\NotificaMovimentoService;
use Illuminate\Console\Command;

class Notifica extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notificacoes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia notificações de movimentos feitos';
    /**
     * @var NotificaMovimentoService
     */
    private $notificaMovimentoService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(NotificaMovimentoService $notificaMovimentoService)
    {
        parent::__construct();
        $this->notificaMovimentoService = $notificaMovimentoService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->notificaMovimentoService->init();
    }
}
