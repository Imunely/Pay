<?php

namespace Imynely\Pay\Services\Config;

use App\PaymentGateway;
use App\PaymentSystem;

final class DatabaseConfig extends AbstractConfig
{

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        if (!$this->config = PaymentSystem::where('name', $griver = $attributes['driver'])->get()->first()) {

            throw new \InvalidArgumentException("Driver [$griver] not supported. See database", 1);
        }
    }

    public function driver(): string
    {
        return $this->config->name;
    }

    public function setGateway(string $gateway): void
    {
        if (!$gateway = PaymentGateway::where('name', $gateway)->first()) {

            throw new \InvalidArgumentException("Gateway [$gateway] not supported. See database", 1);
        }

        $this->config['gateway'] = $gateway;
    }

    function client_id(): string
    {
        return $this->config->client_id;
    }

    function client_secret(): string
    {
        return $this->config->client_secret;
    }

    function api_url(): string
    {
        return $this->config->api_url;
    }

    function callback_url(): string|null
    {
        return $this->config->callback_url;
    }

    function additional(): array
    {
        return json_decode($this->config->additional, true);
    }
}
