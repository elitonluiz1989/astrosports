<div class="sidebar__videos sidebar-left__wrapper">
    <header>
        <h1 class="sidebar__videos-title">Últimos Vídeos</h1>
    </header>
    <ul class="list">
        @if ($videos->isNotEmpty())
            @foreach ($videos as $video)
                <li class="list-item">
                    <div class="sidebar--left__videos-item">
                        <a href="{{ $video['url'] }}" class="sidebar--left__videos-content" target="_blank">
                            <img src="{{ $video['thumb'] }}" alt="{{ $video['title']  }}" title="{{ $video['title'] }}" class="img">
                        </a>
                    </div>
                </li>
            @endforeach
            <li class="list-item">
                <a class="sidebar--left__videos-more btn btn-default" href="/videos">Mais vídeos</a>
            </li>
        @else
            <li class="list-item">
                <div class="sidebar--left__videos--no-videos">Sem vídeos<br>...</div>
            </li>
        @endif
    </ul>
</div>
