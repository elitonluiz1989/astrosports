<?php

namespace App\Repositories\Contracts;

interface PhotosRepositoryInterface
{
    public function getAlbum($albumId);

    public function getAlbums();

    public function getPhotos($albumId = null);

    public function setSize(int $width, int $height);
}