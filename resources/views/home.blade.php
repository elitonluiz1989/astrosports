@php $homeTitleClass = 'home__title col-xs-10 col-sm-6 col-md-4'; @endphp

@extends('layout.app')

@section('title', 'Início')

@php $photosQty = count($photos); @endphp

@section('content')
    <div class="home page">
        <!-- Photos -->
        <div id="home-gallery" class="home__galery home__wrapper carousel slide" data-ride="carousel">
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
            <div class="carousel-inner">
                @foreach ($photos as $photo)
                    @php $class = ($loop->first) ? 'carousel-item active' : 'carousel-item'; @endphp

                    <div class="{{ $class }}">
                        <img class="home__photo" src="{{ $photo->img }}" alt="{{ $photo->alt }}">
                    </div>
                @endforeach
            </div>

            <!-- Controls -->
            <a class="carousel-control-prev" href="#home-gallery" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#home-gallery" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- History -->
        <div id="home-history" class="home__history home__wrapper">
            <header class="{{ $homeTitleClass }}">
                <h1 class="home__title-text">A Escola</h1>
            </header>
            <section class="home__history-content col-12">{!! $history !!}</section>
            <a href="/sobre/historia" id="home-history-toggle" class="home__history-toggle">Continue lendo...</a>
        </div>
        <!-- News -->
        @if (isset($news) && count($news) > 0)
            <div class="home__news home__wrapper">
                <header class="{{ $homeTitleClass }}">
                    <h1 class="home__title-text">Últimas Notícias</h1>
                </header>

                @include('partials.news-list', ['news' => $news])

                <div class="col-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <a class=" home__news-more btn btn-default" href="/noticias">Mais Notícias</a>
                </div>
            </div>
        @endif
    </div>
@endsection
