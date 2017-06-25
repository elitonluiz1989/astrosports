@php
echo '<pre>'; var_dump($schedules); echo '</pre>';
$tabData = [
    'days' => [ 'mon' => 'SEG', 'tue' => 'TER', 'wed' => 'QUA', 'thu' => 'QUI', 'fri' => 'SEX', 'sat' => 'SÁB' ],
    'data' => null
];

$tabItems = [
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
        <h2 class="page-title schedules-title">Horários</h2>
    </header>
@endsection

@section('tabs-content')
    <div class="schedules-list col-xs-12">
        <div class="row hidden-xs">
            <div class="schedules-list-title col-lg-3">
                <div class="schedules-list-title col-sm-2"></div>
            </div>
            <div class="col-lg-9">
                @foreach ($tabData['days'] as $day)
                    <div class="schedules-list-title col-sm-2">{{ $day }}</div>
                @endforeach
            </div>
        </div>
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
                $tabData['key1'] = 'pole';
                $tabData['key2'] = 'category';
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
                $tabData['key1'] = 'pole';
                $tabData['key2'] = 'hour';
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
                $tabData['key1'] = 'category';
                $tabData['key2'] = 'hour';
            @endphp

            @include('partials.schedules-tab-content', $tabData)
        @endcomponent
    </div>
@endsection
