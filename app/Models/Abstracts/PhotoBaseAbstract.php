<?php

namespace App\Models\Abstracts;

abstract class PhotoBaseAbstract extends ImageBaseAbstract
{
    protected $folder = 'photos';

    /**
     * @return mixed|string
     * @throws \ReflectionException
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