<?php

return [
    /*
    |--------------------------------------------------------------------------
    | VNPAY Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for VNPAY payment gateway.
    | You can set your VNPAY credentials here.
    |
    */
    
    'tmn_code' => env('VNPAY_TMN_CODE', 'AOW8RUDV'),
    'hash_secret' => env('VNPAY_HASH_SECRET', 'S3VJYY1C6GMVBBFTG0XUGQW12D750OH2'),
    'url' => env('VNPAY_URL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
    'return_url' => env('VNPAY_RETURN_URL', 'https://shopcuaech.com/payment-result'),
    'api_url' => env('VNPAY_API_URL', 'http://sandbox.vnpayment.vn/merchant_webapi/merchant.html'),
];