<?php

namespace Imynely\Pay\Drivers;

use Imynely\Pay\Contract\Payment;
use Illuminate\Http\Request;
use Imynely\Pay\Contract\Config;
use Imynely\Pay\Drivers\Providers\AbstractProvider;

abstract class AbstractDriver implements Payment
{

    protected $config;

    public function __construct(Request $request, Config $config)
    {
        $this->config = $config;
    }


    function resolve()
    {
    }


    public function create(array $attributes)
    {
        $attributes = $this->validateCreationAttributes($attributes);

        $this->config->setGateway($attributes['gateway']);

        return $this->buildProvider()->create();
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

    protected function buildProvider(string $provider): AbstractProvider
    {
        return new $provider($this->config);
    }
}
