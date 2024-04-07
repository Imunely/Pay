<?php

namespace Imynely\Pay\Drivers;

use Imynely\Pay\Contract\Transaction;
use Imynely\Pay\Providers\PayouProvider;

class PayouDriver extends AbstractDriver
{
    public function redirect()
    {
    }

    public function create(array $attributes = []): \App\Payment
    {
        parent::create($attributes);

        return $this->provider()
            ->createTransaction($attributes['amount'], $attributes['penalty']);
    }

    public function callback()
    {
        return $this->provider()->createCallback();
    }

    function status()
    {
    }

    public function getUrl()
    {
    }


    private function provider(): Transaction
    {
        if (!$this->provider) {
            $this->provider = $this->buildProvider(PayouProvider::class);
        }

        return $this->provider;
    }
}
