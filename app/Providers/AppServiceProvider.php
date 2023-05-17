<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Fyear;

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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $fyears = Fyear::pluck('year', 'year');
        
        view()->composer(['admin.includes.navigation'], function ($view) use($fyears) {
                $view->with('fyears', $fyears);
            });
        
        
    }
}
