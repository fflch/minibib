<?php

$submenu1 =  [
    [
        'text' => 'subitem 1',
        'url'  => '/'
    ],
    [
        'text' => 'subitem 2',
        'url'  => '/',
        'can'  => 'admin',
    ],
    [
        'text' => 'subitem 3',
        'url'  => '/',
    ],
];

$submenu2 =  [
    [
        'text' => 'SubItem 1',
        'url'  => '/subitem1'
    ],
    [
        'text' => 'SubItem 2',
        'url'  => '/subitem2',
        'can'  => 'admin',
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
            'text' => 'Ver Catálogo',
            'url'  => '/records'
        ],
        [
            'text' => 'Cadastrar Material',
            'url'  => '/records/create',            
        ],
        [
            'text' => 'Item 3',
            'url'  => '/item3',
            'can'  => 'admin',
        ],
        [
            'text'    => 'SubMenu1',
            'submenu' => $submenu1,
            'can'  => 'admin',
        ],
        [
            'text'    => 'SubMenu2',
            'submenu' => $submenu2,
            'can'  => 'admin',
        ]
    ]
];
