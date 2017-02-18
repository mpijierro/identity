<?php

namespace MPijierro\Identity;

use Illuminate\Support\ServiceProvider;

;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__ . '/../vendor/autoload.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        \App::bind('Identity', function () {
            return new Identity();
        });

    }
}
