@extends('partials.tabs.page', ['page' => 'about'])

@section('page-class', 'about page')

@section('title', 'Sobre')

@section('tabs-header')
    <header class='row'>
        <h2 class='page__title about__title'>Sobre a escola</h2>
    </header>
@endsection

@section('tabs-content')
    <!-- History -->
    @component('partials.tabs.content')
        @slot('tabContentId', 'historia')

        @if ($display == 'historia')
            @slot('isActive', true)
        @else
            @slot('isActive', false)
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
    @component('partials.tabs.content')
        @slot('tabContentId', 'cartilha')

        @if ($display == 'cartilha')
            @slot('isActive', true)
        @else
            @slot('isActive', false)
        @endif

        {!! $primer ?? $emptyMessage !!}
    @endcomponent

    <!-- Players -->
    @component('partials.tabs.content')

        @slot('tabContentId', 'jogadores')

        @if ($display == 'jogadores')
            @slot('isActive', true)
        @else
            @slot('isActive', false)
        @endif

        @if (isset($players))
            @include('about.content', ['records' => $players])
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent

    <!-- Committee -->
    @component('partials.tabs.content')
        @slot('tabContentId', 'comissao')

        @if ($display == 'comissao')
            @slot('isActive', true)
        @else
            @slot('isActive', false)
        @endif

        @if (isset($commission))
            @include('about.content', ['records' => $commission])
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent
@endsection