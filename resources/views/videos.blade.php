@extends('template.app')

@section('title', 'Vídeos')

@section('page', 'videos')

@section('content')
    <header class="row">
        <h2 class="page__title videos__title">Vídeos</h2>
    </header>
    <div class="row">
        <ul class="videos__list">
            @foreach ($videos as $key => $video)
                @php
                    $videosItemClass =  'col-md-4';
                    $videoImg = $video['thumb']->medium->url;

                    if ($loop->first) {
                        $videosItemClass =  'col-md-8';
                        $videoImg = $video['thumb']->high->url;
                    }
                @endphp
                <li class="videos__item col-xs-12 {{ $videosItemClass }}">
                    <a href="{{ $video['url'] }}" class="videos__item-content" target="_blank">
                        <img src="{{ $videoImg }}" alt="{{ $video['description'] }}" class="img" title="{{ $video['title'] }}">
                    </a>
                </li>
            @endforeach
            <li>
                <a href="{{ $channel }}" class="videos__channel-link btn btn-default" target="_blank">Visite nosso canal</a>
            </li>
        </ul>
    </div>
@endsection
