<?php

return [
    'payforu' => [
        'url' => env('PAYFORU_URL'),
        'customer_id' => env('PAYFORU_CUSTOMER_ID'),
        'api_key' => env('PAYFORU_API_KEY'),
        'api_signature_key' => env('PAYFORU_API_SIGNATURE_KEY'),
        'callback' => env('PAYFORU_CALLBACK'),
    ],

    'coinpay' => [
        'url' => env('COINPAY_URL'),
        'mid' => (string) env('COINPAY_MID'),
        'skey' => env('COINPAY_SKEY'),
    ],

    'kassify' => [
        'url' => env('KASSIFY_URL'),
        'mid' => (string) env('KASSIFY_MID'),
        'skey' => env('KASSIFY_SKEY'),
    ],

    'betatransfer' => [
        'mid' => env('BETATRANSFER_MID'),
        "skey" => env('BETATRANSFER_SKEY'),
        'url' => env('BETATRANSFER_URL'),
    ],

    'skypay' => [
        'url' => env('SKYPAY_URL'),
        'skey' => env('SKYPAY_SKEY'),
        'back_url' => env('APP_URL'),
        'callback_url' => env('SKYPAY_CALLBACK')
    ],

    'payou' => [
        'url' => env('PAYOU_URL'),
        'skey' => env('PAYOU_SKEY'),
        'mid' => (string) env('PAYOU_MID')
    ],
];
