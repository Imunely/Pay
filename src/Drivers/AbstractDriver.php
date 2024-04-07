<?php

namespace Imynely\Pay\Drivers;

use Imynely\Pay\Contract\Payment;
use Illuminate\Http\Request;
use Imynely\Pay\Contract\Config;
use Imynely\Pay\Contract\Transaction;


abstract class AbstractDriver implements Payment
{

    /**
     *
     * @var \Imynely\Pay\Contract\Config
     */
    protected $config;

    /**
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     *
     * @var \Imynely\Pay\Contract\Transaction
     */
    protected $provider;

    
    public function __construct(Request $request, Config $config)
    {
        $this->config = $config;
        $this->$request = $request;
    }


    public function create(array $attributes)
    {
        $attributes = $this->validateCreationAttributes($attributes);

        $this->config->setGateway($attributes['gateway']);
    }


    private function validateCreationAttributes(array $attributes)
    {
        if (!array_key_exists('gateway', $attributes)) {

            throw new \InvalidArgumentException("Argument [gateway] is required");
        }

        if (!array_key_exists('amount', $attributes)) {

            throw new \InvalidArgumentException("Argument [amount] is required");
        }

        return $attributes;
    }


    protected function buildProvider(string $provider): Transaction
    {
        return new $provider($this->config);
    }
}
