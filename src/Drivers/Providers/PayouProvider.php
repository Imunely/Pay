<?php

namespace Imynely\Pay\Drivers\Providers;

class PayouProvider extends AbstractProvider
{

    // public function __construct($request, $config)
    // {
    //     parent::__construct($request, $config);
    // }

    public function createTransaction()
    {
        $data = [
            'id' => config('tools.payments.payou.mid'),
            'summ' => $this->convertAmount(),
            'order_id' => $this->payment->id,
            'customer_id' => $this->payment->id,
            'hash' => md5(config('tools.payments.payou.mid') . ":" . $this->convertAmount() . ":" . config('tools.payments.payou.skey') . ":" . $this->getCurrency() . ":" . $this->payment->id),
            'sistems' => $this->getCurrency(),
            'Coment' => 'You deposit funds into your account in ' . config('app.name'),
            'user_email' => (Auth::user()->email ?? Auth::user()->username)
        ];

        $this->payment->update([
            'link' => config('tools.payments.payou.url') . http_build_query($data)
        ]);

        return $this->payment;
    }

    function buildSettings()
    {
        return $this->config;
    }
}
