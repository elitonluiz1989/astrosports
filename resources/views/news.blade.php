@extends('layout.app')

@section('title', 'Notícias')

@section('page', 'news')

@section('content')
    <header class="row">
        <h2 class="page__title news__title">Notícias</h2>
    </header>
    @php $showChosenNews = $showChosenNews ?? false; @endphp
    @if ($showChosenNews)
        @include('partials.news-full', $news)
    @else
        @if ($news->isEmpty())
            <p class="news__empty">Sem registros</p>
        @else
            <!--
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
            -->

            @include('partials.pagination-bar', $pagination)

            @include('partials.news-list', $news)

            @include('partials.pagination-bar-bottom', $pagination)
        @endif
    @endif
@endsection
