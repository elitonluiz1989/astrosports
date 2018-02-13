<?php

namespace App\Models\Abstracts;

abstract class PhotoBaseAbstract extends ImageBaseAbstract
{
    /**
     * @return string
     */
    public function getLinkAttribute()
    {
        $childClassName = (new \ReflectionClass(\get_called_class()))->getShortName();
        if ($childClassName == "Albums")
        {
            return config('photos.url.album') . $this->id;
        } else {
            return $this->source;
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