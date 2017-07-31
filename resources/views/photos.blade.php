@extends('partials.tabs.index')

@section('page', 'photos')

@section('title', 'Fotos')

@section('tabs-header')
    <header class="row">
        <h2 class="page__title photos__title">Vídeos</h2>
    </header>
@endsection

@section('tabs-content')
    <!-- Photos -->
    @component('partials.tabs.item')
        @slot('tabId')
            photos
        @endslot
        @if ($display == 'photos' || $display == 'album')
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (count($photos) > 0)
            @php
                $tabsBody['records'] = $photos;
            @endphp

            @if (isset($albumName) && null != $albumName)
                <div class="row">
                    <div class="photos__album col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-lg-4 col-lg-offset-4">
                        <div class="photos__album-back">
                            <a href="{{ config('photos.url.photos') }}">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                        </div>
                        <div class="photos__album-title">{{ $albumName }}</div>
                    </div>
                </div>
            @endif

            @include('partials.photos-tab-content', $tabsBody)
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent

    <!-- Albums -->
    @component('partials.tabs.item')
        @slot('tabId')
            albums
        @endslot

        @if ($display == "albums")
            @slot('tabActive')
                in active
            @endslot
        @endif

        @if (count($albums) > 0)
            @php
                $tabsBody['records'] = $albums;
            @endphp

            @include('partials.photos-tab-content', $tabsBody)
        @else
            {!! $emptyMessage !!}
        @endif
    @endcomponent
@endsection
