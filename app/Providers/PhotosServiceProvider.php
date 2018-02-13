<?php

namespace App\Providers;

use App\Repositories\Contracts\PhotosRepositoryInterface;
use App\Repositories\FacebookPhotosRepository;
use App\Repositories\PhotosRepository;
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
        $service = config('photos.service');

        if ($service == 'facebook'){
            $this->app->bind(PhotosRepositoryInterface::class, FacebookPhotosRepository::class);
        } else {
            $this->app->bind(PhotosRepositoryInterface::class, PhotosRepository::class);
        }
    }

    public function provides()
    {
        return [FacebookPhotosRepository::class];
    }
}
