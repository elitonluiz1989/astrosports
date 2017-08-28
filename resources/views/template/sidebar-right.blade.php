<aside class="sidebar sidebar--right col-sm-2 hidden-xs">
    @if (isset($advertising) && count($advertising) > 0)
        <ul class="advertising">
            <li>
                <h2 class="advertising__title sidebar__title">Parceiros</h2>
            </li>
            @foreach( $advertising as $record)
                <li class="advertising__item">
                    <a href="{{ $record['url'] }}" {{ $record->target }} class="advertising__content">
                        <img src="{{ $record['img'] }}" alt="{{ $record['name'] }}" class="img">
                    </a>
                </li>
            @endforeach
            <li class="advertising__item">
                <a href="/contato/parceria" class="advertising__content advertising__content--join">Anúncie aqui</a>
            </li>
        </ul>
    @endif
</aside>
