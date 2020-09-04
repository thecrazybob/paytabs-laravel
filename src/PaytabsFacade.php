<?php

namespace Thecrazybob\PaytabsLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Thecrazybob\Paytabs\Paytabs
 */
class PaytabsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Paytabs';
    }
}
