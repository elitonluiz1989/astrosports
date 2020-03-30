<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Storage;

trait ImageHandler
{
    /**
     * Image sub path
     *
     * @var string
     */
    public $subPath;

    /**
     * @param string|null $image
     * @return string
     */
    public function getImagePath(string $image = null)
    {
        $path = config('image.path');
        
        if (null != $this->subPath)
        {
            $path .= DIRECTORY_SEPARATOR . $this->subPath;
        }

        if (null != $image)
        {
            $path .= DIRECTORY_SEPARATOR . $image;
        }

        return $path;
    }

    /**
     * @param string|null $image
     * @return string
     */
    public function getImageFullPath(string $image = null)
    {
        return Storage::disk(env('FILESYSTEM_DRIVER'))->path($this->getImagePath($image));
    }

    /**
     * Method to clean image path
     *
     * @param string $image - image path
     *
     * @return string
     */
    public function getFileName(string $image)
    {
        return basename($image);
    }
}