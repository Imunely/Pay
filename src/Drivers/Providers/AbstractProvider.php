<?php

namespace Imynely\Pay\Drivers\Providers;

use App\Payment;
use Illuminate\Http\Request;

abstract class AbstractProvider
{

    protected $settings = [
        // 'Currency1' => [
        //     'Gateway1' => [
        //         'name' => 'Gateway1',
        //         'commission' => 1,
        //     ],
        // ],
    ];

    protected $payment;

    protected $request;

    protected $config;



    public function __construct(Request $request, array $config)
    {
        $this->request = $request;
        $this->config = $config;
    }


    function setAttr($currency, $gateway, $amount) {
        
    }

    function validateAttribute($currency, $gateway, $amount)
    {
        if ($this->invalidCurrency($currency) || $this->invalidGateway($currency, $gateway)) {

            throw new \Exception("Invalid currency:{$currency} or gateway:{$gateway}", 1);
        }
    }


    public function create($currency, $gateway, $amount)
    {
       
    }

    public function getTotalAmount(): float
    {
        return round($this->payment->amount / $this->getCommision(), 2);
    }

    private function getCommision(): float|int
    {
        return $this->settings[$this->currency][$this->gateway]['commision'];
    }

    private function invalidCurrency(string $currency): bool
    {
        return array_key_exists($currency, $this->settings);
    }

    private function invalidGateway(string $currency, string $gateway): bool
    {
        return array_key_exists($gateway, $this->settings[$currency]);
    }
}
