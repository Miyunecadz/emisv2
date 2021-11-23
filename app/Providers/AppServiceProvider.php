<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Blade::if('onlyAdmin', function(){
            return Auth::user()->role == User::$ADMIN;
        });

        Blade::if('adminAndHrmo', function(){
            return Auth::user()->role == User::$ADMIN || Auth::user()->role == User::$HRMO;
        });
    }
}
