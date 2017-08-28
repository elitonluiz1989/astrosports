<?php

namespace App\Models\Abstracts;

abstract class PhotoBaseAbstract extends ImageBaseAbstract
{
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
            return $this->img;
        }
    }


    protected function definingImg()
    {
        $cover = config('photos.cover');
        $resize = '?w=' . $cover['width'] . '&h=' . $cover['height'];
        $img = $this->attributes['cover'] ?? $this->attributes['name'];

        return $img . $resize;
    }
}