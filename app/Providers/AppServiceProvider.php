<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

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
        // Model::unguard();
        Paginator::useBootstrapFive();

        // if (config('app.env') === 'local') {
        //     URL::forceScheme('https');
        // }

        if (env(key: 'APP_ENV') !=='local') {
            URL::forceScheme(scheme:'https');
          }
    }
}
