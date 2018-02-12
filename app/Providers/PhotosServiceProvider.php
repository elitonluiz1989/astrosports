<?php

namespace App\Providers;

use App\Repositories\Contracts\PhotosRepositoryInterface;
use App\Repositories\FacebookPhotosRepository;
use Illuminate\Support\ServiceProvider;

class PhotosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PhotosRepositoryInterface::class, FacebookPhotosRepository::class);
    }

    public function provides()
    {
        return [FacebookPhotosRepository::class];
    }
}
