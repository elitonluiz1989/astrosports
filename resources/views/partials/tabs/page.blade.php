@extends('layout.app')

@section('content')
    <div class="@yield('page-class')">
        @yield('tabs-header')

        <div class="row">
            @php
                $navSettings = [
                    'navId' => $page . '-tabs',
                    'navItems' => $navItems,
                    'target' => $display
                ];
            @endphp

            @include('partials.tabs.nav', $navSettings)
        </div>

        <div class="row">
            <div class="tab-content col-12">
                @yield('tabs-content')
            </div>
        </div>
    </div>
@endsection
