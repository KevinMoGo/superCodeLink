<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // hacemos que siempre sea por https incluso en local
        if (config('app.env') !== 'local') {
            \URL::forceScheme('https');
        }
        
    }
}
