<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public const HOME = '/';
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){\URL::forceScheme('https');}
}
