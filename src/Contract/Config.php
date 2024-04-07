<?php

namespace Imynely\Pay\Contract;


interface Config
{
    public function __construct(array $attributes);

    public function config(): \App\PaymentSystem|array;

    public function driver(): string;

    public function client_id(): string;

    public function client_secret(): string;

    public function api_url(): string;

    public function callback_url(): string|null;

    public function additional(): array;

    public function setGateway(string $gateway): void;

    public static function instance(array $attributes): self;
}
