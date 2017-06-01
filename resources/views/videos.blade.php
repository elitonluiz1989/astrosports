@extends('template.app')

@section('title', 'Vídeos')

@section('content')
    <div class="videos page">
        <header class="row">
            <h2 class="page-title videos-title">Vídeos</h2>
        </header>
        <div class="row">
            <ul class="videos-list">
                @foreach ($videos as $key => $video)
                    @php $videosItemClass = ($loop->first) ? 'col-md-8' : 'col-md-4'; @endphp
                    <li class="videos-item col-xs-12 {{ $videosItemClass }}">
                        <iframe class="videos-item-content" src="{{ $video }}" frameborder="0" allowfullscreen></iframe>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
