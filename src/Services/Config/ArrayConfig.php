<?php

namespace Imynely\Pay\Services\Config;

use Illuminate\Support\Facades\Config;

final class ArrayConfig extends AbstractConfig
{
    public function __construct(array $attributes)
    {
        if (!($this->config = Config::get('payments.array.' . $attributes['driver'], []))) {
            throw new \InvalidArgumentException("Driver {$attributes['driver']} not supported. See config", 1);
        }

        parent::__construct($attributes);
    }

    public function driver(): string
    {
        return $this->attributes['driver'];
    }

    public function setGateway(string $gateway): void
    {
        if (!$gateway = $this->config['gateways'][$gateway]) {

            throw new \InvalidArgumentException("Gateway [$gateway] not supported. See config", 1);
        }

        $this->config['gateway'] = $gateway;
    }

    function client_id(): string
    {
        return $this->config['client_id'];
    }

    function client_secret(): string
    {
        return $this->config['client_secret'];
    }

    function api_url(): string
    {
        return $this->config['api_url'];
    }

    function callback_url(): string|null
    {
        return $this->config['callback_url'] ?? null;
    }

    function additional(): array
    {
        return $this->config['additional'] ?? [];
    }

    function commission(): float
    {
        return $this->getGateway('commission', 1.00);
    }

    function systemGateway(): string
    {
        return $this->getGateway('system_gateway');
    }

    function merchantCommission(): float
    {
        return $this->getGateway('merchant_commission', 1.00);
    }

    function currency(): string
    {
        return $this->getGateway('currency');
    }

    private function getGateway(string $key, mixed $default = null): mixed
    {
        if (!array_key_exists('gateway', $this->config)) {
            throw new \InvalidArgumentException("Gataway not supported. See config", 1);
        }

        return array_key_exists($key, $this->config['gateway']) ?
            $this->config['gateway'][$key] : $default;
    }
}
