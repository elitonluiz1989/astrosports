#!/bin/bash

main() {
    if [ "${1}" == 'reset' ]; then
        echo "Optimize class loader"
        php artisan optimize

        echo "Clear Cache facade value"
        php artisan cache:clear

        echo "Clear Route cache"
        php artisan route:clear

        echo "Clear View cache"
        php artisan view:clear

        echo "Clear Config cache"
        php artisan config:cache
    else
        echo "Autoloader Optimization"
        composer install --optimize-autoloader --no-dev

        echo "Optimizing Configuration Loading"
        php artisan config:cache

        echo "Optimizing Route Loading"
        php artisan route:cache
    fi

    echo "Finished!"
}

main $1

exit