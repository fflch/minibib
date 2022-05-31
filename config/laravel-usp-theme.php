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

$right_menu = [
    [
    'key' => 'senhaunica-socialite',
    ],
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
            'text'    => 'Estatísticas',
            'url' => '/statistics',
            'can'     => 'admin'
        ],
    ],
    'right_menu' => $right_menu,
];
