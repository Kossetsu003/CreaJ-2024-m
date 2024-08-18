<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'mercado' => [ // Cambia el nombre del guard a 'mercado'
            'driver' => 'session',
            'provider' => 'mercados', // Asegúrate de que el provider coincida
        ],

        'vendedor' => [
            'driver' => 'session',
            'provider' => 'vendedores',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'mercados' => [
            'driver' => 'eloquent',
            'model' => App\Models\MercadoLocal::class, // Asegúrate de que este modelo exista
        ],

        'vendedores' => [
            'driver' => 'eloquent',
            'model' => App\Models\Vendedor::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'vendedores' => [
            'provider' => 'vendedores',
            'table' => 'password_reset_tokens', // Asegúrate de que esta tabla exista
            'expire' => 60,
            'throttle' => 60,
        ],

        'mercados' => [
            'provider' => 'mercados',
            'table' => 'password_reset_tokens', // Asegúrate de que esta tabla exista
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
