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
            'text' => 'Item 2',
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
        ]
    ]
];
