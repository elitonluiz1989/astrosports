<?php

namespace App\Repositories;

use App\Models\FacebookPhoto;

class LegacyPhotosRepository
{
    private $photos;

    public function __construct(PhotosRepository $photos)
    {
        $this->photos = $photos;
    }

    public function getAlbums($id = null) {
        $legacyAlbums = $this->photos->getAlbums($id);

        return $legacyAlbums->map(function($album) {
            $facebookPhoto =  new FacebookPhoto();

            $facebookPhoto->id = $album->id;
            $facebookPhoto->name = $album->name;
            $facebookPhoto->source = $album->cover;

            return $facebookPhoto;
        });
    }
}