<?php

namespace App\Repositories\Contracts;


interface PhotosRepositoryInterface
{
    public function getAlbums();

    public function getPhotos();

    public function setSize(int $width, int $height);
}