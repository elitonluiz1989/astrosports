#!/bin/sh
echo "---> Start migration"
php artisan migrate --step;

echo "---> Start seeding"
php artisan db:seed;

echo "---> Start apache"
apache2ctl stop && apache2ctl -D FOREGROUND