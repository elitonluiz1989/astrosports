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

    @include('partials.news-list', ['news', $news])

    @include('partials.pagination-bar-bottom', $pagination)
@endsection
