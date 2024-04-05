<?php

namespace Imynely\Pay\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * @method static \Imynely\Pay\Contract\Payment driver(string $driver)
 *
 */

class Pay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'pay';
    }
}
