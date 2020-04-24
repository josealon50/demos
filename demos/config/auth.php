<?php
return [
    'defaults' => [
        'guard' => 'v1',
        'passwords' => 'users',
    ],

    'guards' => [
        'v1' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Users::class
        ]
    ]
];

