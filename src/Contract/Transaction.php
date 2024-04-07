<?php

namespace Imynely\Pay\Contract;

use App\Payment;

interface Transaction
{
    public function __construct(Config $config);

    public function createTransaction(float $amount, int $penalty = null): Payment;

    public function createCallback(): Payment;

    // public function createDispute();

    // public function setCallback();

    // public function getStatus();
}
