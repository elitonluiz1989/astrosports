<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta id="app-token" name="app-token" value="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <base href="/">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Astro Sports - Dashboard</title>

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

    @php
        $authenticaded = Auth::check();

        $bodyClass = ($authenticaded) ? 'dashboard' : 'dashboard--login';
    @endphp

    <body class="{{ $bodyClass }}">
        <div id="app" class="app">
            @if ($authenticaded)
                <dashboard current-page="{{ $currentPage }}"></dashboard>
            @else
                <dashboard-login></dashboard-login>
            @endif
        </div>

        <script src="/js/manifest.js"></script>
        <script src="/js/vendor.js"></script>
        <script src="/js/app.js"></script>
    </body>
</html>
