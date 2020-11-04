<?php

$records =  [
    [
        'text' => 'Listar',
        'url'  => '/records'
    ],
    [
        'text' => 'Cadastrar',
        'url'  => '/records/create',
    ],
];

$users =  [
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
    'logout_method' => 'POST',
    'logout_url' => '/logout',
    'login_url' => '/login',
    'menu' => [
        [
            'text'    => 'Material',
            'submenu' => $records,
            'can'     => 'admin'
        ],
        [
            'text' => 'Usuários',
            'submenu' => $users,
            'can'     => 'nao_usado'
        ],
    ]
];
