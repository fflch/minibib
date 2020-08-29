<?php

$submenu1 =  [
    [
        'text' => 'Listar Catálogo',
        'url'  => '/records'
    ],
    [
        'text' => 'Cadastrar Material',
        'url'  => '/records/create',
    ],
];

$submenu2 =  [
    [
        'text' => 'Listar Registros',
        'url'  => '/instance'
    ],
    [
        'text' => 'Cadastrar ID',
        'url'  => '/instance/create',
    ],
];

$submenu3 =  [
    [
        'text' => 'Listar Usuários',
        'url'  => '/users'
    ],
    [
        'text' => 'Cadastrar Usuários',
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
            'text'    => 'Catálogo de Material',
            'submenu' => $submenu1,
        ],
        [
            'text'    => 'ID E Tombo',
            'submenu' => $submenu2,
        ],
        [
            'text' => 'Usuários',
            'submenu' => $submenu3,          
        ],
    ]
];
