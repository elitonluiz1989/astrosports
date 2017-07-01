@extends('partials.tabs.index')

@section('page', 'photos')

@section('title', 'Fotos')

@php
    $emptyMessage = '<p class="about-empty">Sem registros.</p>';

    $tabItems = [
        'photos' => [
            'url'  => '#photos',
            'text' => 'Fotos'
        ],
        'albums' => [
            'url'  => '#albums',
            'text' => 'Albuns'
        ]
    ];

    $params = [
        'target'     => $display,
        'pagination' => [
            'class' => 'photos-navigation',
            'limit' => $limit
        ]
    ];

    $photosUrl = ($display == 'album') ? '/fotos/album/{albumId}' : '/fotos';
@endphp

@section('tabs-header')
    <header class="row">
        <h2 class="page__title photos__title">Vídeos</h2>
    </header>
@endsection

@section('tabs-content')
    <!-- Photos -->
    @component('partials.tabs.item')
        @slot('tabId')
            photos
        @endslot

        @if ($display == "photos" || $display == "album" )
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (count($photos) > 0)
            @php
                $params['pagination']['url'] = $photosUrl;
                $params['contents'] = $photos;
            @endphp

            @include('partials.photos-tab-content', $params)
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent

    <!-- Albums -->
    @component('partials.tabs.item')
        @slot('tabId')
            albums
        @endslot

        @if ($display == "albums")
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (count($albums) > 0)
            @php
                $params['pagination']['url'] = '/fotos/album/';
                $params['contents'] = $albums;
            @endphp

            @include('partials.photos-tab-content', $params)
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent
@endsection
