<?php

namespace Imynely\Pay\Facades;

use App\PaymentGateway;

class Gateway
{
    public static function driver(string $gateway): string|null
    {
        return PaymentGateway::where('name', $gateway)->get()->first()?->system?->driver;
    }
}
