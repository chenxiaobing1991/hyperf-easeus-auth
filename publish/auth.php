<?php

return [
    'enable' => (bool)env('AUTH_SSO_ENABLED', true),
    'guard' => env('AUTH_SSO_GUARD', 'default'),
    'guards' => [
        'default' => [
            'driver' => \Cxb\Hyperf\Easeus\Auth\Driver\DefaultDriver::class,
            'address' => env('AUTH_SSO_ADDRESS', 'http://account-center-dev.sit.easeus.com/micro-users'),
//            'username' => 'nacos',
//            'password' => 'nacos',
        ],
    ],
//    'guards' => [
//        'dev' => [
//            'uri' => 'http://192.168.0.9:8089',//开发
//        ],
//        'test' => [
//            'uri' => 'http://account-center-dev.sit.easeus.com/micro-users',//测试
//        ],
//        'prod' => [
//            'uri' => 'http://account-center.sit.easeus.com/micro-users',//生产
//        ],
//    ],
//    'drivers' => [
//        'default' => [
//            'driver' => \App\Component\Admin\IdentityManager::class,
//        ]
//    ]
];
