@php
$tabData = ['data' => null];

$tabsNavItems = [
    'schedules' => [
        'url'  => '#schedules',
        'text' => 'Horários'
    ],
    'categories' => [
        'url'  => '#categories',
        'text' => 'Categorias'
    ],
    'poles' => [
        'url'  => '#poles',
        'text' => 'Polos'
    ]
];
@endphp

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

        @php
            $tabData['data'] = $schedules;
            $tabData['wantedField'] = 'category';
        @endphp

        @include('partials.schedules-tab-content', $tabData)
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

        @php
            $tabData['data'] = $categories;
            $tabData['wantedField'] = 'hour';
        @endphp

        @include('partials.schedules-tab-content', $tabData)
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

        @php
            $tabData['data'] = $poles;
            $tabData['wantedField'] = 'hour';
        @endphp

        @include('partials.schedules-tab-content', $tabData)
    @endcomponent
@endsection
