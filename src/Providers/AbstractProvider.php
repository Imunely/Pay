<?php

namespace Imynely\Pay\Providers;

use Illuminate\Http\Request;
use Imynely\Pay\Contract\Config;
use Imynely\Pay\Contract\Transaction;
use Imynely\Pay\Drivers\Service\Payment;

abstract class AbstractProvider implements Transaction
{
    use Payment;

    /**
     *
     * @var Config
     */
    protected $config;

    /**
     *
     * @var Request
     */
    protected $request;


    public function __construct(Request $request, Config $config)
    {
        $this->config = $config;
        $this->request = $request;
    }

    protected function realAmount(float $amount): float
    {
        return round($amount / ($this->config->gateway()->commission ?? 1.00), 2);
    }


    protected function payAttributes(float $amount, int $penalty_id = null): array
    {
        return [
            'user_id' => $this->request->user()->id,
            'gateway_id' => $this->config->gateway()->id,
            'penalty_id' => $penalty_id,
            'amount' => $amount,
            'real_amount' => $this->realAmount($amount),
        ];
    }
}
