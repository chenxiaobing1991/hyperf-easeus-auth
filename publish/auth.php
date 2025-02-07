<?php

use function Hyperf\Support\env;

return [
    'enable' => (bool)env('AUTH_SSO_ENABLED', true),
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
