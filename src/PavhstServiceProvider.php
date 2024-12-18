<?php

namespace Moundherb\Pavhst;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Moundherb\Pavhst\Http\Middleware\DomainGuardMiddleware;

class PavhstServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Register the middleware
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(DomainGuardMiddleware::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
