<?php

namespace Imynely\Pay\Drivers;

use Imynely\Pay\Contract\Payment;

class PayouDriver implements Payment
{
    protected $config = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function create(array $attributes = [])
    {
        return __CLASS__;
    }

    public function getUrl()
    {
        // Реализуйте получение URL платежа для платежной системы Qiwi
    }

    public function getAStatus()
    {
        // Реализуйте получение статуса заказа для платежной системы Qiwi
    }
}
