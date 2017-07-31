<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class PhotoBaseAbstract extends Model
{
    /**
     * @return string
     */
    public function getCoverAttribute()
    {
        return 'storage/photos/' . $this->definingCover();
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        $childClassName = (new \ReflectionClass(\get_called_class()))->getShortName();

        if ($childClassName == "Albums")
        {
            return config('photos.url.albums') . $this->id;
        } else {
            return $this->cover;
        }
    }

    /**
     * @return string
     */
    public function getAltAttribute()
    {
        if (isset($this->attributes['description'])) {
            return substr($this->attributes['description'], 0, 100);
        } else {
            $img = $this->definingCover();

            return 'Imagem ' . \ucfirst($img) . ' não carregada.';
        }
    }


    private function definingCover()
    {
        return $this->attributes['cover'] ?? $this->attributes['name'];
    }
}