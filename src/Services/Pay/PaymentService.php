<?php

namespace Imynely\Pay\Drivers\Service;

use App\Payment as Paying;

trait Payment
{
    public function create(array $data)
    {
        return Paying::create($data);
    }


    public function getOrCreate(array $data)
    {
        $payment = Paying::where([
            ['user', $data['user']],
            ['type', $data['gateway']],
            ['amount', $data['amount']],
        ])->first();

        return $payment ? $payment : $this->create($data);
    }
}
