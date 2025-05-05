<?php

return [
    'default' => env('PAYMENT_GATEWAY', 'midtrans'),

    'midtrans' => [
        'server_key' => env('PAYMENT_MIDTRANS_SERVER_KEY'),
        'client_key' => env('PAYMENT_MIDTRANS_CLIENT_KEY'),
        'is_production' => env('PAYMENT_MIDTRANS_IS_PRODUCTION', false),
        'api_sandbox_url' => env('PAYMENT_MIDTRANS_API_URL', 'https://api.sandbox.midtrans.com/v2/charge'),
    ]
];

?>
