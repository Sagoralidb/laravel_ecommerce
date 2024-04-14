<?php 
return   
    [
        'currency'          => env('PAYMENT_CURRENCY'),
        'currency_symbol'   => env('PAYMENT_CURRENCY_SYMBOL'),
        'public_key'        => env('STRIPE_ID'),
        'secret_key'        => env('STRIPE_SECRET')

    ];
