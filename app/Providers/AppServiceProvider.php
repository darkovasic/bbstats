<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); 

        view()->composer('layouts.aside', function ($view) {

            // $teams = \App\Team::pluck('name');
            $teams = \App\Team::all();

            $view->with(compact('teams'));
        });      
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
