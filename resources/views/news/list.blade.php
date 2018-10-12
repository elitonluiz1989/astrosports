<ul class="news-list list">
    @foreach( $news as $record )
        <li class="news-list__item">
            <a href="{{ $record->url }}" class="news-list__content">
                <div class="news-list__cover">
                    <img src="{{ $record->source }}" alt="{{ $record->alt }}">
                </div>

                <div class="news-list__subject">{{ $record->title }}</div>

                <div class="news-list__published">{{ $record->published_at }}</div>
            </a>
        </li>
    @endforeach
</ul>
