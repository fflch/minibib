<?php

$submenu1 =  [
    [
        'text' => 'Listar',
        'url'  => '/records'
    ],
    [
        'text' => 'Cadastrar',
        'url'  => '/records/create',
    ],
];

$submenu2 =  [
    [
        'text' => 'Listar',
        'url'  => '/instance'
    ],
];

$submenu3 =  [
    [
        'text' => 'Listar',
        'url'  => '/users'
    ],
    [
        'text' => 'Cadastrar',
        'url'  => '/users/create',
    ],
];


return [
    'title'=> 'USPdev',
    'dashboard_url' => '/',
    'logout_method' => 'GET',
    'logout_url' => '/logout',
    'login_url' => '/login',
    'menu' => [
        [
            'text' => 'Item 1',
            'url'  => '/',
            'can'  => 'admin',
        ],
        [
            'text'    => 'Material',
            'submenu' => $submenu1,
        ],
        [
            'text'    => 'Acervo',
            'submenu' => $submenu2,
        ],
        [
            'text' => 'Usuários',
            'submenu' => $submenu3,
        ],
    ]
];
