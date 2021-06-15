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
    'title' => config('app.name'),
    'dashboard_url' => config('app.url'),
    'logout_method' => 'POST',
    'logout_url' => config('app.url') . '/logout',
    'login_url' => config('app.url') . '/login',
    'menu' => [
        [
            'text'    => 'Material',
            'submenu' => $records,
            'can'     => 'admin'
        ],
        [
            'text'    => 'Emprestados',
            'url' => '/emprestimos',
            'can'     => 'admin'
        ],
        [
            'text' => 'Usuários',
            'submenu' => $users,
            'can'     => 'nao_usado'
        ],
        [
            'text'    => 'Estatísticas',
            'url' => '/statistics',
            'can'     => 'admin'
        ],
    ]
];
