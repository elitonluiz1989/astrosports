const { mix } = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js/app.js')
    .extract([ 'vue', 'jquery' ])
    .sass('resources/assets/sass/app.scss', 'public/css')
    .browserSync('localhost');
