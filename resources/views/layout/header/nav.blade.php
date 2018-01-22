<div class="row">
    <nav class="header__nav navbar navbar-expand-sm col">
        <a id="header-title-collapsed" class="header-title navbar-brand d-sm-none" href="#">
            <span class="header__title-text">E. F. Astro Sports</span>
        </a>

        <button class="header__nav-toggle navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav" aria-controls="header-nav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars" aria-hidden="true"></i>
      </button>

        <div id="header-nav" class="header__nav-list collapse navbar-collapse">
            <ul class="navbar-nav">
                @foreach ($navItems as $url => $title)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $url }}">{{ $title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
</div>
