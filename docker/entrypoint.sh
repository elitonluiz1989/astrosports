#! /bin/sh

php artisan migrate --step;

php artisan bd:seed;

apache2ctl -D FOREGROUND;