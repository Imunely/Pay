<?php

namespace Imynely\Pay\Contract;

use App\PaymentSystem;
use App\PaymentGateway;

interface Config
{
    public function __construct(array $attributes);

    public static function instance(array $attributes): self;
    public function config(): object;
    public function driver(): string;
    public function client_id(): string;
    public function client_secret(): string;
    public function api_url(): string;
    public function callback_url(): string|null;
    public function additional(): array;
    public function setGateway(string $gateway): void;
    public function gateway(): object;
}
