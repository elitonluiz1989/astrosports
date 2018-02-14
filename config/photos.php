<?php

return [
    'service' => 'photos',
    'views' => [
        'index' => 'photos.index',
        'item' => 'photos.item'
    ],
    'display'       => 'photos',
    'sidebar'       => false,
    'url'           => [
        'album' => 'fotos/album/',
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
    'cover'      =>[
        'width'  => 360,
        'height' => 225
    ],
    'emptyMessage'  => '<p class="tabs-empty">Sem registros.</p>',
    'limit'   => 12
];