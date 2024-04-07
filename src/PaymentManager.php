<?php

namespace Imynely\Pay;

use Illuminate\Support\Facades\Request;
use Imynely\Pay\Drivers\PayouDriver;
use Imynely\Pay\Drivers\CoinPayDriver;
use Imynely\Pay\Contract\Payment;
use Imynely\Pay\Contract\Config;
use Imynely\Pay\Services\Config\DatabaseConfig;
use Imynely\Pay\Services\Config\ArrayConfig;
use Imynely\Pay\Drivers\AbstractDriver;

class PaymentManager
{
    /**
     *
     * @var array
     */
    protected $drivers = [];

    /**
     *
     * @var \Imynely\Pay\Contract\Config
     */
    protected $config;


    /**
     *
     * @var array
     */
    protected $build = [];


    /**
     * Get instance *payment driver* by driver name 
     *
     */
    public function driver(string $driver): Payment
    {
        $this->build['driver'] = $driver;

        return $this->buildDriver($driver);
    }

    protected function createPayouDriver(): \Imynely\Pay\Drivers\AbstractDriver
    {
        return $this->buildProvider(PayouDriver::class);
    }

    protected function createCoinPayDriver(): \Imynely\Pay\Drivers\AbstractDriver
    {
        return $this->buildProvider(CoinPayDriver::class);
    }

    protected function createDatabaseConfig(): Config
    {
        return DatabaseConfig::instance($this->build);
    }

    protected function createArrayConfig(): Config
    {
        return ArrayConfig::instance($this->build);
    }

    private function defaultConnection(): string
    {
        if (!($connaection = \Illuminate\Support\Facades\Config::get('payments.default'))) {

            throw new \InvalidArgumentException("Connection [default] is required. See [payments] config");
        }

        return $connaection;
    }

    private function buildProvider(string $provider): AbstractDriver
    {
        return new $provider(Request::instance(), $this->buildConfig());
    }

    private function buildDriver(string $driver = null): Payment
    {
        if (!isset($this->drivers[$driver ?? ($driver = $this->defaultDriver())])) {
            $method = 'create' . ucfirst($driver) . 'Driver';

            if (!method_exists($this, $method)) {
                throw new \InvalidArgumentException("Driver [$driver] not supported.");
            }

            $this->drivers[$driver] = $this->$method();
        }

        return $this->drivers[$driver];
    }

    private function buildConfig(): Config
    {
        if (!($this->config)) {
            $method = 'create' . ucfirst($this->defaultConnection()) . 'Config';

            if (!method_exists($this, $method)) {
                throw new \InvalidArgumentException("Connection [{$this->defaultConnection()}] not supported.");
            }

            $this->config = $this->$method();
        }

        return $this->config;
    }

    private function defaultDriver(): string
    {
        return $this->buildConfig()->driver();
    }
}
