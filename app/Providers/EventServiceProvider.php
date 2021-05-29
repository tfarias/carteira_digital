<?php

namespace App\Providers;

use App\Events\MovimentoCarteira;
use App\Events\PessoaCreated;
use App\Listeners\CreateCarteiraListener;
use App\Listeners\UpdateCarteiraListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PessoaCreated::class => [
            CreateCarteiraListener::class
        ],
        MovimentoCarteira::class => [
            UpdateCarteiraListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
