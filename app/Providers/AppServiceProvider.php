<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Routing\UrlGenerator;//追記してみた

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \DB::listen(function ($query) {
            $sql = $query->sql;
            for ($i = 0; $i < count($query->bindings); $i++) {
                $sql = preg_replace("/\?/", $query->bindings[$i], $sql, 1);
            }
            \Log::debug("SQL", ["sql" => $sql]);                                                                
        });
    }
    public const HOME = '/';
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){\URL::forceScheme('http');}//デフォルトhttps
    /*public function boot(UrlGenerator $url)
    {
        $url->forceScheme('https');
    }*/
}
