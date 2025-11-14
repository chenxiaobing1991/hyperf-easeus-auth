<?php

use function Hyperf\Support\env;

return [
    'guard' => env('AUTH_SSO_GUARD', 'default'),
    'guards' => [
        'default' => [
            'driver' => null,
            'address' => env('AUTH_SSO_ADDRESS', 'http://127.0.0.1'),
        ],
    ],
];
