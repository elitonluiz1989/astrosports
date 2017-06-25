@php
$emptyMessage = '<p class="about-empty">Sem registros.</p>';
$tabItems = [
    'history' => [
        'url'  => '#history',
        'text' => 'História'
    ],
    'primer' => [
        'url'  => '#primer',
        'text' => 'Cartilha'
    ],
    'players' => [
        'url'  => '#players',
        'text' => 'Jogadores'
    ],
    'committee' => [
        'url'  => '#committee',
        'text' => 'Comissão'
    ]
];
@endphp

@extends('partials.tabs.index')

@section('page', 'about')

@section('title', 'Sobre')

@section('tabs-header')
    <header class="row">
        <h2 class="page-title about-title">Sobre a escola</h2>
    </header>
@endsection

@section('tabs-content')
    <!-- History -->
    @component('partials.tabs.item')
        @slot('tabId')
            history
        @endslot

        @if ($display == "history")
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (isset($history))
            <header class="about-history-header">
                <h1>{{ $history['title'] }}</h1>
            </header>
            <article class="about-history-text">{!! $history['text'] !!}</article>
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent

    <!-- Primer -->
    @component('partials.tabs.item')
        @slot('tabId')
            primer
        @endslot

        @if ($display == "primer")
            @slot('tabActive')
                in active
            @endslot
        @endif

        {!! $primer ?? $emptyMessage !!}
    @endcomponent

    <!-- PLayers -->
    @component('partials.tabs.item')
        @slot('tabId')
            players
        @endslot

        @if ($display == "players")
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (isset($players))
            @include('partials.about-tab-content', ['type' => 'players', 'data' => $players])
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent

    <!-- Committee -->
    @component('partials.tabs.item')
        @slot('tabId')
            committee
        @endslot

        @if ($display == "committee")
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (isset($committee))
            @include('partials.about-tab-content', ['type' => 'committee', 'data' => $committee])
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent
@endsection
