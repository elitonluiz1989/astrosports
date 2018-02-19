@if (isset($advertising) && count($advertising) > 0)
    <div class="sidebar__advertising sidebar__wrapper">
        <h2 class="sidebar__advertising-title sidebar__title">Anúncios</h2>

        @foreach( $advertising as $record)
            <div class="sidebar__advertising-item">
                <a href="{{ $record['url'] }}" {{ $record->target }} class="sidebar__advertising-content">
                    <img src="{{ $record['img'] }}" alt="{{ $record['name'] }}" class="img-fluid">
                </a>
            </div>
        @endforeach

        <div class="sidebar__advertising-item">
            <a href="/contato/anuncios" class="sidebar__advertising-join">Anúncie aqui</a>
        </div>
    </div>
@endif
