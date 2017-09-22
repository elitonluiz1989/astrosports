@inject('template', 'App\Http\Controllers\TemplateController')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta id="app-token" name="app-token" value="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="/">
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
        <div class="row hidden-xs">
            <div class="header-logo col-sm-2"></div>
            <div id="header-title-default" class="header-title col-sm-10">
                <div class="header-title-content">
                    <h1 class="header-title-text">Escola de Futebol Astro Sports</h1>
                    <h2 class="header-title-subtitle">#Descobrindo valores</h2>
                </div>
                <div class="header-contact col-sm-6 col-sm-offset-6">
                    @php
                        $social = $template->social();
                    @endphp

                    @include('template.contact-list', $social)
                </div>
            </div>
        </div>
        @include('template.nav', $template->navItems())
    </header>
    <div id="app" class="content conteiner-fluid">
        <div class="row">
            @php
                $showSidebar = $sidebar ?? true;

                $contentClass = 'page col-xs-12';
            @endphp

            @if ($showSidebar)
                @php $contentClass .= ' col-sm-6 col-md-7'; @endphp

                @php
                    $sidebarLeft = [
                        'schedules'  => $template->schedules(),
                        'videos'     => $template->videos()
                    ];

                    $sidebarRight = [
                        'advertising' => $template->advertising()
                    ];
                @endphp

                @include('template.sidebar-left', $sidebarLeft)
            @endif

            <div class="@yield('page') {{ $contentClass }}">
                @yield('content')
            </div>

            @if ($showSidebar)
                @include('template.sidebar-right', $sidebarRight)
            @endif
        </div>
    </div>

    @include('template.footer', $template->footer())

    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>
