<?php

use function Hyperf\Support\env;

return [
    'guard' => env('AUTH_SSO_GUARD', 'default'),
    'app_key' => env('AUTH_SSO_APP_KEY', ''),
    'guards' => [
        'default' => [
            'driver' =>null,
            'address' => env('AUTH_SSO_ADDRESS', 'http://127.0.0.1'),
        ],
    ],
];
