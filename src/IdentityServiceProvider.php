<?php

namespace MPijierro\Identity;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use MPijierro\Identity\Identity;

class IdentityServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->addRules();

    }


    private function addRules()
    {

        Validator::extend('nif', function ($attribute, $value, $parameters, $validator) {
            $identity = new \MPijierro\Identity\Identity();

            return $identity->isValidNif($value);
        });

        Validator::extend('cif', function ($attribute, $value, $parameters, $validator) {
            $identity = new \MPijierro\Identity\Identity();

            return $identity->isValidCif($value);
        });

        Validator::extend('nie', function ($attribute, $value, $parameters, $validator) {
            $identity = new \MPijierro\Identity\Identity();

            return $identity->isValidNie($value);
        });

        Validator::extend('iban', function ($attribute, $value, $parameters, $validator) {
            $identity = new \MPijierro\Identity\Identity();

            return $identity->isValidIban($value);
        });

        Validator::extend('nnss', function ($attribute, $value, $parameters, $validator) {
            $identity = new \MPijierro\Identity\Identity();

            return $identity->isValidNNSS($value);
        });
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
