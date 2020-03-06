<?php

namespace MPijierro\Identity;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class IdentityServiceProvider extends ServiceProvider implements DeferrableProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->configure(
            'identity',
            __DIR__ . '/resources/config.php'
        );
        $this->app->bind(Identity::class, function () {
            return new Identity();
        });
        $this->app->alias(
            Identity::class,
            'Identity'
        );
    }
    
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

    /**
     * Add rules
     * 
     * @return void
     */
    private function addRules(): void
    {
        Validator::extend('nif', function ($attribute, $value, $parameters, $validator) {
            $identity = new Identity();
            return $identity->isValidNif($value);
        });

        Validator::extend('cif', function ($attribute, $value, $parameters, $validator) {
            $identity = new Identity();
            return $identity->isValidCif($value);
        });

        Validator::extend('nie', function ($attribute, $value, $parameters, $validator) {
            $identity = new Identity();
            return $identity->isValidNie($value);
        });

        Validator::extend('iban', function ($attribute, $value, $parameters, $validator) {
            $identity = new Identity();
            return $identity->isValidIban($value);
        });

        Validator::extend('nnss', function ($attribute, $value, $parameters, $validator) {
            $identity = new Identity();
            return $identity->isValidNNSS($value);
        });
    }

    /**
     * Add messages
     * 
     * @return void
     */
    private function addMessages(): void
    {
        if (! $this->app->make('config')->get('identity.messages')) {
            return;
        }
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
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            Identity::class,
            'Identity'
        ];
    }
}
