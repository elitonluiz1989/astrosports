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
        <div id="main-mask" class="mask">
            <div class="mask__content mask--dark">
                <div class="loader loader--floating loader--show">
                    <div class="spinner"></div>

                    <p class="loader__message"></p>
                </div>
            </div>
        </div>

        <div id="app" style="overflow: hidden">
            <header class="header container-fluid">
                @include('layout.header.title')

                @include('layout.header.nav', $template->navItems())
            </header>

            <div class="content container-fluid">
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

                        @include('layout.sidebar-left', $sidebarLeft)
                    @endif

                    <div class="@yield('page') {{ $contentClass }}">
                        @yield('content')
                    </div>

                    @if ($showSidebar)
                        @include('layout.sidebar-right', $sidebarRight)
                    @endif
                </div>
            </div>

            @include('layout.footer', $template->footer())
        </div>

        <script src="/js/manifest.js"></script>
        <script src="/js/vendor.js"></script>
        <script src="/js/app.js"></script>
    </body>
</html>
