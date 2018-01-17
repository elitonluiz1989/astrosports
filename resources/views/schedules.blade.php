@extends('partials.tabs.index')

@section('page', 'schedules')

@section('title', 'Horários')

@section('tabs-header')
    <header class="row">
        <h2 class="page__title schedules__title">Horários</h2>
    </header>
@endsection

@section('tabs-content')
    <!-- Schedules -->
    @component('partials.tabs.item')
        @slot('tabId')
            schedules
        @endslot

        @if ($display == "schedules")
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (count($schedules) > 0)
            @php
                $tabData['data'] = $schedules;
                $tabData['wantedField'] = 'category';
            @endphp

            @include('partials.schedules-tab-content', $tabData)
        @else
            @include('partials.schedules-no-results', $noResultsMessage)
        @endif
    @endcomponent

    <!-- Categories -->
    @component('partials.tabs.item')
        @slot('tabId')
            categories
        @endslot

        @if ($display == "categories")
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (count($categories) > 0)
            @php
                $tabData['data'] = $categories;
                $tabData['wantedField'] = 'hour';
            @endphp

            @include('partials.schedules-tab-content', $tabData)
        @else
            @include('partials.schedules-no-results', $noResultsMessage)
        @endif
    @endcomponent

    <!-- Poles -->
    @component('partials.tabs.item')
        @slot('tabId')
            poles
        @endslot

        @if ($display == "poles")
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (count($poles) > 0)
            @php
                $tabData['data'] = $poles;
                $tabData['wantedField'] = 'hour';
            @endphp

            @include('partials.schedules-tab-content', $tabData)
        @else
            @include('partials.schedules-no-results', $noResultsMessage)
        @endif
    @endcomponent
@endsection
