<?php

return [
    'default' => [
        'guard' => 'default',
        'driver' => 'default',
    ],
    'guards' => [
        'default' => [
            'uri' => 'http://192.168.0.9:8089',//地址
        ]
    ],
    'drivers' => [
        'default' => [
            'driver' => \App\Component\Admin\IdentityManager::class,
        ]
    ]
];
