@extends('template.app')

@section('title', 'Notícias')

@section('page', 'news')

@section('content')
    <header class="row">
        <h2 class="page__title news__title">Notícias</h2>
    </header>
    <div class="row">
        <form class="news__search navbar-form navbar-right" action="/noticias/pesquisa" method="get" role="search">
            <div class="news__search-field form-group">
                <input type="text" class="news__search-input form-control" placeholder="Pesquise">
            </div>
            <button type="submit" class="news__search-btn btn btn-default">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            </button>
        </form>
    </div>

    @include('partials.pagination-bar', $pagination)

    <ul class="news__list row">
        @foreach( $news as $record )
            <li class="news__item col-xs-12 col-md-10 col-md-offset-1">
                <a href="{{ $record->url }}" class="news__content">
                    <div class="news__cover col-xs-12 col-sm-3 col-lg-4">
                        <img src="{{ $record->img }}" alt="{{ $record->alt }}" class="img">
                    </div>
                    <div class="news__subject col-xs-12 col-sm-9 col-lg-8">{{ $record->title }}</div>
                    <div class="news__published col-xs-12 col-sm-9 col-lg-8">{{ $record->published_at }}</div>
                </a>
            </li>
        @endforeach
    </ul>

    @include('partials.pagination-bar-bottom', $pagination)
@endsection
