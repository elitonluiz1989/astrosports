<?php

namespace App\Models\Abstracts;

abstract class PhotoBaseAbstract extends ImageBaseAbstract
{
    /**
     * @return mixed|string
     * @throws \ReflectionException
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

    /**
     * @return string
     */
    protected function getImgName()
    {
        return $this->attributes['cover'] ?? $this->attributes['name'];
    }

    /**
     * @return array
     */
    protected function getDefaultImgSize()
    {
        return config('photos.cover');
    }
}