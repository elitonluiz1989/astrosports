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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Astro Sports - @yield('title')</title>

    <!-- Bootstrap -->
    <link href="css/app.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <header class="header conteiner-fluid">
        <a href="" class="header-title">
            <h1 id="header-title-default" class="header-title-content">Escola de Futebol Astro Sports</h1>
        </a>
        <nav class="navbar header-nav">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle header-nav-toggle collapsed" data-toggle="collapse" data-target="#header-nav" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
               </button>
               <a id="header-title-collapsed" class="navbar-brand header-title-content" href="#">E. F. Astro Sports</a>
            </div>
            <div id="header-nav" class="collapse navbar-collapse">
                <ul class="nav nav-pills nav-justified">
                    @foreach( $navItems as $uri => $title )
                        <li class="nav-item header-nav-item">
                            <a class="nav-item-content" href="{{ $uri }}">{{ $title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </header>
    <section class="content">
        @yield('content')
    </section>
    <footer class="footer">
        <div class="footer-wrapper">
            <nav class="footer-nav">
                <ul class="nav nav-pills nav-stacked">
                    @foreach( $navItems as $uri => $title )
                        <li class="nav-item footer-nav-item">
                            <a class="nav-item-content" href="{{ $uri }}">{{ $title }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/app.js"></script>
</body>
</html>
