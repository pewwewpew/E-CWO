<?php

namespace App\Providers;

use App\Http\Controllers\Test1Controller;
use App\Http\Controllers\Test2Controller;
use App\Http\Controllers\Test3Controller;
use App\Libraries\AdminAircraftView;
use App\Libraries\AircraftViewInterface;
use App\Libraries\CostumerAircraftView;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
