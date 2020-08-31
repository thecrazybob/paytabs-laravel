<?php

namespace Thecrazybob\PaytabsLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Thecrazybob\PaytabsLaravel\PaytabsLaravel
 */
class PaytabsLaravelFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'paytabs-laravel';
    }
}
