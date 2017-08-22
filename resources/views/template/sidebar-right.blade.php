<aside class="sidebar__left col-sm-2">
    <ul class="advertising list">
    @foreach( $advertising as $record)
        <li class="advertising__item list__item">
            <a href="{{ $record['url'] }}" class="advertising__content">
                <img src="{{ $record['img'] }}" alt="{{ $record['alt'] }}" class="img">
            </a>
        </li>
    @endforeach
    </ul>
</aside>
