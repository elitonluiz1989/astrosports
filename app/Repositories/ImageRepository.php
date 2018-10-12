<?php

namespace App\Repositories;

use App\Handlers\AppLog;
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
     * @param array|string $images - One image or an images list
     * 
     * @return bool
     */
    public function delete($images)
    {
        $files = [];

        if (!is_array($images)) {
            $images = [$images];
        }

        foreach ($images as $image) {
            $filename = $this->removePath($image);
            \array_push($files, $this->_imagePath . '/' . $filename);
        }

        $deleted = Storage::disk(env('FILESYSTEM_DRIVER'))->delete($files);

        if (!$deleted) {
            AppLog::write('warning', '[images][not-deleted]', $files);
        }

        return $deleted;
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