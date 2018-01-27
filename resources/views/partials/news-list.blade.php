<ul class="news-list list row">
    @foreach( $news as $record )
        <li class="news-list__item col-12 col-md-11 col-md-offset-1">
            <a href="{{ $record->url }}" class="news-list__content">
                <div class="news-list__cover col-12 col-sm-3 col-lg-4">
                    <img src="{{ $record->img }}" alt="{{ $record->alt }}" class="img">
                </div>
                <div class="news-list__subject col-12 col-sm-9 col-lg-8">{{ $record->title }}</div>
                <div class="news-list__published col-12 col-sm-9 col-lg-8">{{ $record->published_at }}</div>
            </a>
        </li>
    @endforeach
</ul>
