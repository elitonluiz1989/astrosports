<div class="row">
    <nav class="navbar header-nav col-sm-12">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle header-nav-toggle collapsed" data-toggle="collapse" data-target="#header-nav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a id="header-title-collapsed" class="header-title navbar-brand visible-xs" href="#">
                <span class="header-title-text">E. F. Astro Sports</span>
            </a>
        </div>
        <div id="header-nav" class="header-nav-list collapse navbar-collapse">
            <ul class="nav nav-pills nav-justified">
                @foreach($navItems as $uri => $title )
                    <li class="nav-item header-nav-item">
                        <a class="nav-item-content" href="{{ $uri }}">{{ $title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
</div>