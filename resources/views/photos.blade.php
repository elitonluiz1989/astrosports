@extends('layout.app')

@section('page', 'photos')

@section('content')
    <header class="row">
        <h2 class="page__title photos__title">Fotos</h2>
    </header>

    <div class="row">
        <ul class="photos-tabs nav nav-tabs col-12">
            @foreach ($navItems as $item => $content)
                @php $class = ($display == $item) ? 'tabs-item active' : 'tabs-item'; @endphp
                <li class="{{ $class }}">
                    <a href="{{ $content['url'] }}">{{ $content['text'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Albums -->
    @if ($display == 'albums')
        @if (count($albums) > 0)
            @php
                $photosContent['records'] = $albums;
                $photosContent['showAlbumName'] = true;
            @endphp

            @include('partials.photos-content', $photosContent)
        @else
            {!! $emptyMessage !!}
        @endif
    <!-- Photos -->
    @else
        @if (count($photos) > 0)
            @php
                $photosContent['records'] = $photos;
            @endphp

            @if (isset($albumName) && null != $albumName)
                <div class="row">
                    <div class="photos__album col-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
                        <div class="photos__album-back">
                            <a href="{{ config('photos.url.albums') }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                        </div>

                        <div class="photos__album-title">{{ $albumName }}</div>
                    </div>
                </div>
            @endif

            @include('partials.photos-content', $photosContent)
        @else
            {!! $emptyMessage !!}
        @endif
    @endif
@endsection
