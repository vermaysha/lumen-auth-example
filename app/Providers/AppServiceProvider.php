<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dusterio\LumenPassport\LumenPassport;
use Laravel\Passport\Passport;

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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot() {
        LumenPassport::routes($this->app);

        Passport::tokensCan([
            'admin' => 'Adminstrator user',
            'writer' => 'Writer user',
            'user' => 'Basic user'
        ]);
    }
}
