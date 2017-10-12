@extends('template.app')

@section('title', 'Vídeos')

@section('page', 'videos')

@section('content')
    <header class="row">
        <h2 class="page__title videos__title">Vídeos</h2>
    </header>

    <div class="row">
        <div id="videos-modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <div class="modal-content">
                    <div class="videos-modal__header modal-header">
                        <button type="button" class="close">&times;</button>
                    </div>

                    <div class="modal-body">
                        <iframe></iframe>
                    </div>
                </div>

            </div>
        </div>

        <ul id="videos" class="videos__list">
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
