@if (isset($advertising) && count($advertising) > 0)
    <div class="sidebar__advertising sidebar__wrapper">
        <h2 class="sidebar__advertising-title sidebar__title">Anúncios</h2>

        @foreach( $advertising as $record)
            <div class="sidebar__advertising-item">
                @if ($record->url == '#')
                    <div class="sidebar__advertising-content">
                        <img class="img-fluid" src="{{ $record->source }}" alt="{{ $record->name }}">
                    </div>
                @else
                    <a class="sidebar__advertising-content" href="{{ $record->url}}" {{ $record->target }}>
                        <img class="img-fluid" src="{{ $record->source }}" alt="{{ $record->name }}">
                    </a>
                @endif
            </div>
        @endforeach

        <div class="sidebar__advertising-item">
            <a href="/contato/email?assunto=anuncios" class="sidebar__advertising-join">Anúncie aqui</a>
        </div>
    </div>
@endif
