@extends('partials.tabs.page', ['page' => 'schedules'])

@section('page-class', 'schedules page page--full')

@section('title', 'Horários')

@section('tabs-header')
    <header class="row">
        <h2 class="page__title schedules__title">Horários</h2>
    </header>
@endsection

@section('tabs-content')
    <!-- Schedules -->
    @component('partials.tabs.content')
        @slot('tabContentId', 'horarios')

        @if ($display == "horarios")
            @slot('isActive', true)
        @else
            @slot('isActive', false)
        @endif

        @if (count($schedules) > 0)
            @php
                $tabData['data'] = $schedules;
                $tabData['wantedField'] = 'category';
            @endphp

            @include('schedules.content', $tabData)
        @else
            @include('schedules.no-results', $noResultsMessage)
        @endif
    @endcomponent

    <!-- Categories -->
    @component('partials.tabs.content')
        @slot('tabContentId', 'categorias')

        @if ($display == "categorias")
            @slot('isActive', true)
        @else
            @slot('isActive', false)
        @endif

        @if (count($categories) > 0)
            @php
                $tabData['data'] = $categories;
                $tabData['wantedField'] = 'hour';
            @endphp

            @include('schedules.content', $tabData)
        @else
            @include('schedules.no-results', $noResultsMessage)
        @endif
    @endcomponent

    <!-- Poles -->
    @component('partials.tabs.content')
        @slot('tabContentId', 'polos')

        @if ($display == "polos")
            @slot('isActive', true)
        @else
            @slot('isActive', false)
        @endif

        @if (count($poles) > 0)
            @php
                $tabData['data'] = $poles;
                $tabData['wantedField'] = 'hour';
            @endphp

            @include('schedules.content', $tabData)
        @else
            @include('schedules.no-results', $noResultsMessage)
        @endif
    @endcomponent
@endsection
