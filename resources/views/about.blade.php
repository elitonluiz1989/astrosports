@extends('partials.tabs.index')

@section('page', 'about')

@section('title', 'Sobre')

@section('tabs-header')
    <header class="row">
        <h2 class="page__title about__title">Sobre a escola</h2>
    </header>
@endsection

@section('tabs-content')
    <!-- History -->
    @component('partials.tabs.item')
        @slot('tabId')
            historia
        @endslot

        @if ($display == "historia")
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (isset($history))
            <header class="about__text-wrapper about__history-header">
                <h1>{{ $history['title'] }}</h1>
            </header>
            <article class="about__text-wrapper about__history-text">{!! $history['text'] !!}</article>
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent

    <!-- Primer -->
    @component('partials.tabs.item')
        @slot('tabId')
            cartilha
        @endslot

        @if ($display == "cartilha")
            @slot('tabActive')
                in active
            @endslot
        @endif

        {!! $primer ?? $emptyMessage !!}
    @endcomponent

    <!-- PLayers -->
    @component('partials.tabs.item')
        @slot('tabId')
            jogadores
        @endslot

        @if ($display == "jogadores")
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
            comissao
        @endslot

        @if ($display == "comissao")
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (isset($commission))
            @include('partials.about-tab-content', ['type' => 'committee', 'data' => $commission])
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent
@endsection
