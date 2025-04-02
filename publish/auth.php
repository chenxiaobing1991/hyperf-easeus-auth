<?php

use function Hyperf\Support\env;

return [
    'guard' => env('AUTH_SSO_GUARD', 'default'),
    'guards' => [
        'default' => [
            'driver' => \App\Component\Admin\IdentityManager::class,
            'address' => env('AUTH_SSO_ADDRESS', 'http://127.0.0.1'),
//            'username' => 'nacos',
//            'password' => 'nacos',
        ],
    ],
];
