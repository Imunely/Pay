<?php

namespace Imynely\Pay\Drivers;

use Imynely\Pay\Providers\CoinPayProvider;

class CoinPayDriver extends AbstractDriver
{

    public function redirect()
    {
    }

    public function create(array $attributes = [])
    {
        parent::create($attributes);

        return $this->buildProvider(CoinpayProvider::class)
            ->createTransaction($attributes['amount'], $attributes['penalty']);
    }

    function callback()
    {
    }

    function status()
    {
    }

    public function getUrl()
    {
        // Реализуйте получение URL платежа для платежной системы Qiwi
    }
}
