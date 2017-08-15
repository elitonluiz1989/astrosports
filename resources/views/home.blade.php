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
            @foreach ($photos as $p => $photo)
                @php $class = ($p == 0) ? 'home__photo item active' : 'home__photo item'; @endphp
                <div class="{{ $class }}">
                    <img src="{{ $photo->src }}" alt="{{ $photo->alt }}">
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
        <header class="home__title home__history-title">
            <h1 class="home__title-text">A Escola</h1>
        </header>
        <article class="home__history-content">{!! $history !!}</article>
    </div>
    <!-- News -->
    <div class="home__news home__wrapper">
        <header class="home__title home__news-header">
            <h1 class="home__title-text">Últimas Notícias</h1>
        </header>
        <ul class="list">
            @if (count($news) > 0)
                @foreach ($news as $current)
                    <li class="list-item home__news-wrapper home__news-wrapper--has-news">
                        @php $newsContentClass = "home__news-content"; @endphp
                        @if (!empty($current[ 'cover' ]))
                            @php $newsContentClass .= " home__news-content--with-cover"; @endphp
                            <div class="home__news-cover">
                                <img class="img" src="{{ $current[ 'cover' ] }}?w=300&h=250" alt="cover">
                            </div>
                        @endif
                        <div class="{{ $newsContentClass }}">
                            <div class="home__news-title">{{ $current[ 'title' ] }}</div>
                            <div class="home__news-text">{!! $current[ 'content' ] !!}</div>
                        </div>
                    </li>
                @endforeach
                <li class="list-item home__news-wrapper">
                    <a class=" home__news-more btn btn-default" href="/noticias">Mais Notícias</a>
                </li>
            @else
                <li class="list-item home__news-wrapper--no-news">
                    <div class="home__news-content--no-news">Sem resgistros.</div>
                </li>
            @endif
        </ul>
    </div>
@endsection
