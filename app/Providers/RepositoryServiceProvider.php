<?php

namespace App\Providers;

use App\Repositories\CarteiraRepository;
use App\Repositories\CarteiraRepositoryEloquent;
use App\Repositories\ComunRepository;
use App\Repositories\ComunRepositoryEloquent;
use App\Repositories\LojistaRepository;
use App\Repositories\LojistaRepositoryEloquent;
use App\Repositories\MovimentoRepository;
use App\Repositories\MovimentoRepositoryEloquent;
use App\Repositories\NotificacaoRepository;
use App\Repositories\NotificacaoRepositoryEloquent;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ComunRepository::class, ComunRepositoryEloquent::class);
        $this->app->bind(LojistaRepository::class, LojistaRepositoryEloquent::class);
        $this->app->bind(CarteiraRepository::class, CarteiraRepositoryEloquent::class);
        $this->app->bind(MovimentoRepository::class, MovimentoRepositoryEloquent::class);
        $this->app->bind(NotificacaoRepository::class, NotificacaoRepositoryEloquent::class);
    }
}
