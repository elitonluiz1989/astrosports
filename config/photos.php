<?php
return [
    'display'       => 'photos',
    'sidebar'       => false,
    'url'           => [
        'albums' => 'fotos/albuns/',
        'photos' => 'fotos/'
    ],
    'tabsNavItems'     => [
        'photos' => [
            'url'  => '#photos',
            'text' => 'Fotos'
        ],
        'albums' => [
            'url'  => '#albums',
            'text' => 'Albuns'
        ]
    ],
    'tabsBody'    => [
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
