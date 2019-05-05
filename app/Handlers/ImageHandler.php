<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Storage;

trait ImageHandler
{
    /**
     * Image source path
     *
     * @var string
     */
    public $imagePath;

    /**
     * @param string|null $image
     * @return string
     */
    public function getImagePath(string $image = null)
    {
        $path = $this->imagePath ?? config('image.path');

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
        return pathinfo($image, PATHINFO_FILENAME);
    }
}