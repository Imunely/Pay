<?php

namespace Imynely\Pay;

use Illuminate\Support\Facades\Config;
use InvalidArgumentException;
use Imynely\Pay\Drivers\PayouDriver;
use Imynely\Pay\Drivers\CoinPayDriver;
use Imynely\Pay\Contract\Payment;


class PaymentManager
{
    protected $drivers = [];

    protected $config = [];


    public function driver(string $driver): Payment
    {
        if (!isset($this->drivers[$driver])) {
            $method = 'create' . ucfirst($driver) . 'Driver';

            if (!method_exists($this, $method)) {
                throw new InvalidArgumentException("Driver [$driver] not supported.");
            }

            $this->drivers[$driver] = $this->$driver();
        }

        return $this->drivers[$driver];
    }

    function withConfig(array $config)
    {
        $this->config = $config;
    }


    protected function createPayouDriver()
    {
        $config = $this->driverConfig('payou');

        return new PayouDriver($config);
    }

    protected function createCoinPayDriver()
    {
        $config = $this->driverConfig('coinpay');

        return new CoinPayDriver($config);
    }

    private function driverConfig(string $driver)
    {
        if ($this->invalidDriver($driver)) {
            throw new InvalidArgumentException("Driver [$driver] not supported. See config");
        }

        return array_merge(Config::get("payments.$driver", []), $this->config);
    }

    private function invalidDriver($driver): bool
    {
        return !isset($this->config[$driver]) && !(Config::get("payments.$driver", false));
    }
}
