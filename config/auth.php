<?php

return [
    'defaults' => [
        'guard' => 'jwt',
        'passwords' => 'users',
    ],

    'guards' => [
        'jwt' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\User::class
        ]
    ],
    'ttl' => 24 * 3600
];
