<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Astro sports - contato</title>

        <style type="text/css">
            .email__content {
                float: left;
                width: 90%;
                margin: 10px 5%;
                text-align: justify;
            }
        </style>
    </head>

    <body>
        <div class="email__content">{{ $sender['content'] }}</div>
    </body>
</html>