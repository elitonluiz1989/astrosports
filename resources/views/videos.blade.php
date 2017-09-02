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
                <li class="videos__item col-xs-12 col-md-4">
                    <a href="{{ $video['url'] }}" class="videos__item-content" target="_blank">
                        <img src="{{ $video['thumb'] }}" alt="{{ $video['description'] }}" class="videos__item-thumb" title="{{ $video['title'] }}">
                        <div class="videos__item-title">{{ $video['title'] }}</div>
                    </a>
                </li>
            @endforeach
            <li>
                <a href="{{ $channel }}" class="videos__channel-link btn btn-default" target="_blank">Visite nosso canal</a>
            </li>
        </ul>
    </div>
@endsection
