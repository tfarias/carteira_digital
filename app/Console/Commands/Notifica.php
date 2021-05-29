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
    private $notificaService;


    /**
     * Create a new command instance.
     * @return void
     */
    public function __construct(NotificaMovimentoService $notificaService)
    {
        parent::__construct();
        $this->notificaService = $notificaService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->notificaService->init();
    }
}
