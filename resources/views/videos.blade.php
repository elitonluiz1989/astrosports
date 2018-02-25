@extends('layout.app')

@section('title', 'Vídeos')

@section('content')
    <div class="videos page">
        <header class="row">
            <h2 class="videos__title page__title">Vídeos</h2>
        </header>

        <ul id="videos" class="videos__list row justify-content-center">
            @component('partials.modal')
                @slot('modalId', 'videos-modal')

                <iframe></iframe>
            @endcomponent

            @foreach ($videos as $key => $video)
                <li class="videos__item col-12 col-md-8 col-lg-6">
                    <a href="{{ $video['url'] }}" class="videos__item-content" target="_blank">
                        <img src="{{ $video['thumb'] }}" alt="{{ $video['description'] }}" class="videos__item-thumb" title="{{ $video['title'] }}">

                        <div class="videos__item-title">{{ $video['title'] }}</div>
                    </a>
                </li>
            @endforeach

            <li class="col-12">
                <a href="{{ $channel }}" class="videos__channel-link btn btn-light" target="_blank">Visite nosso canal</a>
            </li>
        </ul>

    </div>
@endsection
