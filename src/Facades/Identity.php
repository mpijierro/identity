<?php

namespace MPijierro\Identity\Facades;

use Illuminate\Support\Facades\Facade;

class Identity extends Facade
{

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Identity'; // the IoC binding.
    }
}
