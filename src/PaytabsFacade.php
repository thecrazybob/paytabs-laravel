<?php

namespace Thecrazybob\PaytabsLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Thecrazybob\PaytabsLaravel\Paytabs
 */
class PaytabsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'paytabs';
    }
}
