<?php

namespace Azzarip\ApiBasicAuth\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Azzarip\ApiBasicAuth\ApiBasicAuth
 */
class ApiBasicAuth extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Azzarip\ApiBasicAuth\ApiBasicAuth::class;
    }
}
