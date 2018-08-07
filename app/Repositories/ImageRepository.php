<?php

namespace App\Repositories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageRepository
{
    /**
     * Image route string
     * 
     * @var string
     */
    public $imageRoute;

    /**
     * Image source path
     * 
     * @var string
     */
    private $_imagePath;

    /**
     * ImageRepository constructor
     */
    public function __construct()
    {
        $this->_imagePath = '/images';
    }

    /**
     * Delete stored images
     * 
     * @param array $images - images list
     * 
     * @return bool
     */
    public function delete($images)
    {
        $images = collect($images);

        $files = $images->map(
            function ($image) {
                $filename = $this->removePath($image);
                $path = $this->_imagePath . $filename;

                return $path;
            }
        );

        return Storage::disk(env('FILESYSTEM_DRIVER'))->delete($files->toArray());
    }

    /**
     * Store image handler
     * 
     * @param UploadedFile $image - image to upload
     * 
     * @return string
     */
    public function upload(UploadedFile $image)
    {
        $newName = md5(uniqid(rand(), true)) . '.' . $image->extension();
        $image->storeAs($this->_imagePath, $newName);

        return route($this->imageRoute, ['image' => $newName], false);
    }

    /**
     * Method to clean image path
     * 
     * @param string $image - image path
     * 
     * @return string
     */
    public function removePath(string $image)
    {
        $filename = explode('/', trim($image));
        return $filename[count($filename) - 1];
    }
}