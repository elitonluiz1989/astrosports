@extends('partials.tabs.page')

@section('page', 'about')

@section('title', 'Sobre')

@section('tabs-header')
    <header class='row'>
        <h2 class='page__title about__title'>Sobre a escola</h2>
    </header>
@endsection

@section('tabs-content')
    <!-- History -->
    @component('partials.tabs.content-item')
        @slot('tabId')
            history
        @endslot

        @if ($display == 'history')
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (isset($history))
            <header class='about__text-wrapper about__history-header'>
                <h1>{{ $history['title'] }}</h1>
            </header>
            <article class='about__text-wrapper about__history-text'>{!! $history['text'] !!}</article>
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent

    <!-- Primer -->
    @component('partials.tabs.content-item')
        @slot('tabId')
            primer
        @endslot

        @if ($display == 'primer')
            @slot('tabActive')
                in active
            @endslot
        @endif

        {!! $primer ?? $emptyMessage !!}
    @endcomponent

    <!-- PLayers -->
    @component('partials.tabs.content-item')
        @slot('tabId')
            players
        @endslot

        @if ($display == 'players')
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (isset($players))
            @include('partials.about-tab-content', ['type' => 'players', 'records' => $players])
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent

    <!-- Committee -->
    @component('partials.tabs.content-item')
        @slot('tabId')
            commission
        @endslot

        @if ($display == 'commission')
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (isset($commission))
            @include('partials.about-tab-content', ['type' => 'committee', 'records' => $commission])
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent
@endsection