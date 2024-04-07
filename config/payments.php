<?php

use Illuminate\Support\Facades\File;

return [

    /**
     * Supported database, array drivers
     */

    'default' => env('DEFAULT_DRIVER', 'database'),

    'array' => [
        'payforu' => [
            'api_url' => env('PAYFORU_URL'),
            'client_id' => env('PAYFORU_API_KEY'),
            'client_secret' => env('PAYFORU_API_SIGNATURE_KEY'),
            'callback_url' => env('PAYFORU_CALLBACK'),
            'additional' => [
                'customer_id' => env('PAYFORU_CUSTOMER_ID'),
            ],

            'gateways' => File::get(storage_path('app/payments/payforu')),
        ],

        'coinpay' => [
            'api_url' => env('COINPAY_URL'),
            'client_id' => (string) env('COINPAY_MID'),
            'client_secret' => env('COINPAY_SKEY'),

            // 'gateways' => File::get(storage_path('app/payments/payforu')),

        ],

        'kassify' => [
            'api_url' => env('KASSIFY_URL'),
            'client_id' => (string) env('KASSIFY_MID'),
            'client_secret' => env('KASSIFY_SKEY'),

            // 'gateways' => File::get(storage_path('app/payments/payforu')),
        ],

        'betatransfer' => [
            'client_id' => env('BETATRANSFER_MID'),
            'client_secret' => env('BETATRANSFER_SKEY'),
            'api_url' => env('BETATRANSFER_URL'),

            // 'gateways' => File::get(storage_path('app/payments/payforu')),
        ],

        'skypay' => [
            'api_url' => env('SKYPAY_URL'),
            'client_secret' => env('SKYPAY_SKEY'),
            'callback_url' => env('SKYPAY_CALLBACK'),
            'additional' => [
                'back_url' => env('APP_URL'),
            ],

            // 'gateways' => File::get(storage_path('app/payments/payforu')),

        ],

        'payou' => [
            'api_url' => env('PAYOU_URL'),
            'client_secret' => env('PAYOU_SKEY'),
            'client_id' => (string) env('PAYOU_MID')
        ],

        // 'gateways' => File::get(storage_path('app/payments/payou')),
    ]
];
