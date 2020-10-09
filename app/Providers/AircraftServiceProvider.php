<?php
//gunakan class ini untuk bind interface yang berhubungan dengan model aircraft
namespace App\Providers;

use App\Libraries\Interfaces\AircraftDataInterface;
use App\Libraries\Interfaces\UserAuthInterface;
use App\Libraries\Services\EloquentAircraftData;
use App\Libraries\Services\EloquentUserData;
use Illuminate\Support\ServiceProvider;

class AircraftServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //binding penarikan data ke class yang menggunakan eloquent query laravel
        $this->app->bind(AircraftDataInterface::class,EloquentAircraftData::class);
        $this->app->bind(UserAuthInterface::class,EloquentUserData::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
