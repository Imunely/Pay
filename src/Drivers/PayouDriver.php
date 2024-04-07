<?php

namespace Imynely\Pay\Drivers;

use App\Payments\CoinPay;
use Illuminate\Http\Request;
use Imynely\Pay\Contract\Payment;
use Imynely\Pay\Drivers\Gateways\CoinPayGateway;
use Imynely\Pay\Drivers\Gateways\PayouGateway;
use Imynely\Pay\Drivers\Providers\PayouProvider;

class PayouDriver 
{
    protected $config = [];

    /**
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request, array $config)
    {
        $this->config = $config;
        $this->request = $request;

        parent::__construct();
    }

    public function create(array $attributes = [])
    {
        return $this->config;
    }

    public function createOrGet(array $attributes = [])
    {
        return $this->config;
    }

    public function redirect(float $amount, string $gateway): string
    {
        return new PayouProvider();

        return '';
    }

    function ifNotExists()
    {
        $this->config['not_exists'] = true;

        return $this;
    }

    public function callback()
    {

    }

    public function status(int $id = null)
    {
    }

    function getUrl()
    {
    }


    public function buildProvider()
    {
        return new PayouProvider();
    }
}
