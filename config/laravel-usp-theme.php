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

$right_menu = [
    [
        'text' => '<i class="fas fa-hard-hat"></i>',
        'title' => 'Logs',
        'target' => '_blank',
        'url' => config('app.url') . '/logs',
        'align' => 'right',
        'can' => 'admin',
    ],
];

return [
    'title' => config('app.name'),
    'skin' => env('USP_THEME_SKIN', 'uspdev'),
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
    ],
    'right_menu' => $right_menu,
];
