<?php

namespace MPijierro\Identity;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Translation\Translator;

class IdentityServiceProvider extends ServiceProvider implements DeferrableProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/resources/config.php',
            'identity'
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
        $this->app->make(Translator::class)
                ->getLoader()
                ->addJsonPath(__DIR__ . '/resources/lang');
        
        Validator::replacer('nif', function ($message, $attribute, $rule, $parameters) {
            return __('identify.validation.nif', ['attribute' => $attribute]);
        });

        Validator::replacer('cif', function ($message, $attribute, $rule, $parameters) {
            return __('identify.validation.cif', ['attribute' => $attribute]);
        });

        Validator::replacer('nie', function ($message, $attribute, $rule, $parameters) {
            return __('identify.validation.nie', ['attribute' => $attribute]);
        });

        Validator::replacer('iban', function ($message, $attribute, $rule, $parameters) {
            return __('identify.validation.iban', ['attribute' => $attribute]);
        });

        Validator::replacer('nnss', function ($message, $attribute, $rule, $parameters) {
            return __('identify.validation.nnss', ['attribute' => $attribute]);
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
