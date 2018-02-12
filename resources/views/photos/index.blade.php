@extends('template.app')

@section('page', 'photos')

@section('title', 'Fotos')

@section('content')
    <header class="row">
        <h2 class="page__title photos__title">Fotos</h2>
    </header>

    <div class="row">
        <ul class="photos-tabs nav nav-tabs col-xs-12">
            @foreach ($navItems as $item => $content)
                @php $class = ($display == $item) ? 'tabs-item active' : 'tabs-item'; @endphp
                <li class="{{ $class }}">
                    <a href="{{ $content['url'] }}">{{ $content['text'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    @if (count($records['records']) > 0)
        @if (isset($albumName) && null != $albumName)
            @include('photos.album-title', ['name' => $albumName])
        @endif

        @include('photos.item', $records)
    @else
        {!! $emptyMessage !!}
    @endif
@endsection
