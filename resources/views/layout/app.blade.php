@php
$navItems = [
    "/" => "Início",
    "/avaliacoes" => "Avaliações",
    "/contato" => "Contato",
    "/fotos" => "Fotos",
    "/horarios" => "Horários",
    "/videos" => "Vídeos",
    "/sobre" => "Sobre"
];

@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta id="app-token" name="app-token" value="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Astro Sports - @yield('title')</title>

    <!-- Bootstrap -->
    <link href="css/app.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <header class="header conteiner-fluid">
        <div class="row">
            <div id="header-title-default" class="header-title header-title-default col-sm-12">
                <h1 class="header-title-content">
                    <div class="header-title-text">Escola de Futebol Astro Sports</div>
                    <div class="header-title-subtitle">Descobrindo valores</div>
                </h1>
            </div>
        </div>
        <div class="row">
            <nav class="navbar header-nav col-sm-12">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle header-nav-toggle collapsed" data-toggle="collapse" data-target="#header-nav" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                   </button>
                   <a id="header-title-collapsed" class="header-title navbar-brand" href="#">
                       <span class="header-title-text">E. F. Astro Sports</span>
                   </a>
                </div>
                <div id="header-nav" class="header-nav-list collapse navbar-collapse">
                    <ul class="nav nav-pills nav-justified">
                        @foreach( $navItems as $uri => $title )
                            <li class="nav-item header-nav-item">
                                <a class="nav-item-content" href="{{ $uri }}">{{ $title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <section class="content conteiner-fluid">
        <div class="row">
            @php
                $withSidebar = $layoutSidebar ?? true;
                $contentClass = "content__main col-xs-12";
            @endphp

            @if ( $withSidebar )
                @include('layout.sidebar-left')
                @php $contentClass .= " col-sm-8 col-md-9"; @endphp
            @endif

            <section class="{{ $contentClass }}">
                <div class="content__wrap">
                    @yield('content')
                </div>
            </section>
        </div>
    </section>
    <footer class="footer conteiner-fluid">
        <section class="row">
            <ul class="footer-contact list-inline col-xs-12 col-md-12 col-lg-10 col-lg-offset-1">
                <li class="footer-item col-xs-12 col-sm-3 col-lg-2">
                    <div class="footer-content">(00) 0000-0000</div>
                </li>
                <li class="footer-item col-xs-12 col-sm-1">
                    <div class="footer-content footer-content--separator visible-xs">...</div>
                    <div class="footer-content footer-content--separator visible-sm-up hidden-xs">.</div>
                </li>
                <li class="footer-item col-xs-12 col-sm-3 col-lg-3">
                    <div class="footer-content">exemple@exemple.com</div>
                </li>
                <li class="footer-item col-xs-12 col-sm-1">
                    <div class="footer-content footer-content--separator visible-xs">...</div>
                    <div class="footer-content footer-content--separator visible-sm-up hidden-xs">.</div>
                </li>
                <li class="footer-item col-xs-12 col-sm-4 col-lg-5">
                    <div class="footer-content">Rua exemplo, 000 - bairro exemplo - cidade/UF</div>
                </li>
            </ul>
        </section>
    </footer>

    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>
