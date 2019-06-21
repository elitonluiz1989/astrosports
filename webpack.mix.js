const {mix} = require("laravel-mix");
let path = require("path");

mix.disableNotifications();

mix.webpackConfig({
    resolve: {
        alias: {
            "@js": path.resolve(__dirname, "resources/assets/js"),
            "@components": path.resolve(__dirname, "resources/assets/js/components"),
            "@Dashboard": path.resolve(__dirname, "resources/assets/js/components/Dashboard")
        }
    }
});

mix.js("resources/assets/js/app.js", "public/js/app.js")
    .extract([ "vue", "jquery" ])
    .sass("resources/assets/sass/app.scss", "public/css")
    .browserSync("localhost");
