<div class="header__nav-wrapper row">
    <nav class="header__nav navbar navbar-expand-sm col">
        <a id="header-title-collapsed" class="header-title navbar-brand d-sm-none" href="#">
            <span class="header__title-text">E. F. Astro Sports</span>
        </a>

        <button class="header__nav-toggle navbar-toggler" type="button" data-toggle="collapse" data-target="#header-nav" aria-controls="header-nav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars" aria-hidden="true"></i>
      </button>

        <div id="header-nav" class="header__nav-list collapse navbar-collapse">
            <ul class="navbar-nav nav-fill">
                @foreach ($navItems as $url => $title)
                    @php $navLinkClass = ($url == $current) ? 'nav-link nav-link--active' : 'nav-link'; @endphp
                    <li class="nav-item">
                        <a class="{{ $navLinkClass }}" href="{{ $url }}">{{ $title }}</a>
                    </li>
                @endforeach

                <li class="nav-item">
                    <a href="/dashboard" class="nav-link dashboard__link">Área restrita</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
