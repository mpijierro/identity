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

        $this->addMessages();

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


    private function addMessages()
    {
        Validator::replacer('nif', function ($message, $attribute, $rule, $parameters) {

            return "The $attribute field is not a valid NIF.";

        });

        Validator::replacer('cif', function ($message, $attribute, $rule, $parameters) {

            return "The $attribute field is not a valid CIF.";


        });

        Validator::replacer('nie', function ($message, $attribute, $rule, $parameters) {

            return "The $attribute field is not a valid NIE.";

        });

        Validator::replacer('iban', function ($message, $attribute, $rule, $parameters) {

            return "The $attribute field is not a valid IBAN.";

        });

        Validator::replacer('nnss', function ($message, $attribute, $rule, $parameters) {

            return "The $attribute field is not a valid Social Security  Number.";

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
