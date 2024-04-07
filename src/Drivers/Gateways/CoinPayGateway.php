<?php

namespace Imynely\Pay\Drivers\Gateways;

final class CoinPayGateway
{

    public function get(): array
    {
        return [
            'inr' => [
                'Payou_UPI' => [
                    'name' => 'ala_MoneyINR',
                    'commision' => 1.13
                ],

                'Payou_IMPS' => [
                    'name' => 'IMPS_mir',
                    'commision' => 1
                ],

                'Payou_PayTM' => [
                    'name' => 'card_INR_v4',
                    'commision' => 1
                ]
            ],

            'kzt' => [
                'payou' => [
                    'name' => 'card_KZT',
                    'commision' => 1
                ]
            ],

            'uzs' => [
                'payou' => [
                    'name' => 'card_UZS_v2',
                    'commision' => 1
                ]
            ],
        ];
    }


}
