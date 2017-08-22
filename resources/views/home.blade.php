@php $homeTitleClass = 'home__title col-xs-10 col-sm-6 col-md-4 col-xs-offset-1'; @endphp

@extends('template.app')

@section('title', 'Início')

@section('page', 'home')

@php $photosQty = count($photos); @endphp

@section('content')
    <!-- Photos -->
    <div id="home-photos" class="home__galery home__wrapper carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @for ($i = 0; $i < $photosQty; $i++)
                @if ($i == 0)
                    <li data-target="#home-photos" data-slide-to="{{ $i }}" class="active"></li>
                @else
                    <li data-target="#home-photos" data-slide-to="{{ $i }}"></li>
                @endif
            @endfor
        </ol>

        <!-- Conteiner for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach ($photos as $photo)
                @php $class = ($loop->first) ? 'home__photo item active' : 'home__photo item'; @endphp
                <div class="{{ $class }}">
                    <img src="{{ $photo->img }}" alt="{{ $photo->alt }}">
                    @if ( $photo->description )
                        <div class="carousel-caption">{{ $photo->description }}</div>
                    @endif
                </div>
            @endforeach
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#home-photos" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#home-photos" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- History -->
    <div class="home__history home__wrapper">
        <header class="{{ $homeTitleClass }}">
            <h1 class="home__title-text">A Escola</h1>
        </header>
        <section class="home__history-content col-xs-12">{!! $history !!}</section>
        <a href="/sobre/historia" id="home-history-show" class="home__history-show">continue lendo...</a>
    </div>
    <!-- News -->
    @if (count($news) > 0)
        <div class="home__news home__wrapper">
            <header class="{{ $homeTitleClass }}">
                <h1 class="home__title-text">Últimas Notícias</h1>
            </header>

            @include('partials.news-list', ['news' => $news])

            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <a class=" home__news-more btn btn-default" href="/noticias">Mais Notícias</a>
            </div>
        </div>
    @endif
@endsection
