@extends('layout.app')

@section('page', 'photos')

@section('content')
    <div class="photos page page--full">
        <header class="row">
            <h2 class="page__title photos__title">Fotos</h2>

            <ul class="photos-tabs nav nav-tabs col-12">
                @foreach ($navItems as $item => $content)
                    @php $class = ($display == $item) ? 'nav-link tab--active' : 'nav-link'; @endphp
                    <li class="nav-item">
                        <a class="{{ $class }}" href="{{ $content['url'] }}">{{ $content['text'] }}</a>
                    </li>
                @endforeach
            </ul>
        </header>

        @if (count($records['records']) > 0)
            @if (isset($albumName) && null != $albumName)
                @include('photos.album-title', ['name' => $albumName])
            @endif

            @include('photos.item', $records)
        @else
            {!! $emptyMessage !!}
        @endif
    </div>
@endsection
