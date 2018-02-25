@php $showChosenNews = $showChosenNews ?? false; @endphp

@extends('layout.app')

@section('title', 'Notícias')

@section('content')
<div class="news page">
    <header class="row">
        <h2 class="page__title news__title">Notícias</h2>
    </header>

    <div class="row justify-content-center">
          <div class="col-11">              
                @if ($showChosenNews)
                  @include('news.full', $news)
                @else
                  @if ($news->isEmpty())
                      <p class="news__empty">Sem registros</p>
                  @else
                      @include('partials.pagination-bar', $pagination)

                      @include('news.list', $news)

                      @include('partials.pagination-bar-bottom', $pagination)
                  @endif
                @endif
          </div>
      </div>
</div>
@endsection
