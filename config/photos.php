<?php
return [
    'display'       => 'photos',
    'sidebar'       => false,
    'url'           => [
        'albums' => 'fotos/albuns/',
        'photos' => 'fotos/'
    ],
    'navItems'     => [
        'photos' => [
            'url'  => '/fotos',
            'text' => 'Fotos'
        ],
        'albums' => [
            'url'  => 'fotos/albuns/',
            'text' => 'Albuns'
        ]
    ],
    'photosContent'    => [
        'pagination' => [
            'links'   => null
        ]
    ],
    'cover'      =>[
        'width'  => 300,
        'height' => 250
    ],
    'emptyMessage'  => '<p class="tabs-empty">Sem registros.</p>',
    'limit'   => 12
];
