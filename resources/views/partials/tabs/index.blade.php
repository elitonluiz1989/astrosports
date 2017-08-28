@extends('template.app')

@section('content')
    @yield('tabs-header')

    <div class="row">
        <ul class="@yield('page')-tabs tabs nav nav-tabs col-xs-12">
            @foreach ($tabsNavItems as $item => $content)
                @php $class = ($display == $item) ? 'tabs-item active' : 'tabs-item'; @endphp
                <li role="presentation" class="{{ $class }}">
                    <a href="{{ $content['url'] }}" data-toggle="tab">{{ $content['text'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="row">
        <div class="tab-content">
            @yield('tabs-content')
        </div>
    </div>
@endsection
