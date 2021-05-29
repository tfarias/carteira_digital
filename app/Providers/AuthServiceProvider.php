<?php

namespace App\Providers;

use App\Models\Pessoa;
use App\Policies\AutorizadorPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Pessoa::class => AutorizadorPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}
