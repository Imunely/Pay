<?php

namespace Imynely\Pay\Drivers;

use Illuminate\Http\Request;
use Imynely\Pay\Contract\Config;
use Imynely\Pay\Contract\Payment;

class CoinPayDriver 
{

    protected $attributes = [];

    protected $config = [];

    public function __construct(Request $request, Config $config)
    {
        $this->config = $config;
    }


    public function redirect()
    {
    }


    public function create(array $attributes = [])
    {
        // Реализуйте создание заказа для платежной системы Qiwi
    }

    public function getUrl()
    {
        // Реализуйте получение URL платежа для платежной системы Qiwi
    }

    function buildProvider()
    {
    }
}
