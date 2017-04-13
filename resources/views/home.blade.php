@extends('layout.app')

@section('title', 'Início')

@php $photosQty = count($photos); @endphp

@section('content')
    <div class="home">
        <!-- Photos -->
        <div id="home-photos" class="home-photos home-wrapper carousel slide" data-ride="carousel">
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

            <!-- wrapperper for slides -->
            <div class="carousel-inner" role="listbox">
                @foreach ($photos as $p => $photo)
                    @php $class = ($p == 0) ? 'home-photos__photo item active' : 'home-photo item'; @endphp
                    <div class="{{ $class }}">
                        <img src="{{ $photo[ 'src' ] }}" alt="foto {{ $p }}">
                        @if ( $photo[ 'description' ] )
                            <div class="carousel-caption">{{ $photo[ 'description' ] }}</div>
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
        <div class="home-history home-wrapper">
            <header class="home-title home-history__title">
                <h1 class="home-title__text">A Escola</h1>
            </header>
            <article class="home-history__content">{!! $history !!}</article>
        </div>
        <!-- News -->
        <div class="home-news home-wrapper">
            <header class="home-title home-news__title">
                <h1 class="home-title__text">Últimas Notícias</h1>
            </header>
            <ul class="list">
                @if (count($news) > 0)
                    @foreach ($news as $current)
                        <li class="list__item home-news__wrapper home-news__wrapper--has-news">
                            @php $newsContentClass = "home-news__content"; @endphp
                            @if (!empty($current[ 'cover' ]))
                                @php $newsContentClass .= " home-news__content--withcover"; @endphp
                                <div class="home-news__cover">
                                    <img class="img" src="{{ $current[ 'cover' ] }}" alt="cover">
                                </div>
                            @endif
                            <div class="{{ $newsContentClass }}">
                                <div class="home-news__content-title">{{ $current[ 'title' ] }}</div>
                                <div>{!! $current[ 'content' ] !!}</div>
                            </div>
                        </li>
                    @endforeach
                    <li class="list__item home-news__wrapper">
                        <a class=" home-news__btn-more btn btn-default" href="/noticias">Mais Notícias</a>
                    </li>
                @else
                    <li class="list__item home-news__wrapper">
                        <div class="home-news__no-news">Sem resgistros.</div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endsection
