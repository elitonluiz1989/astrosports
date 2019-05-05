<?php

namespace App\Repositories;

use App\Handlers\AppLog;
use App\Handlers\ImageHandler;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageRepository
{
    use ImageHandler;

    /**
     * Image route string
     * 
     * @var string
     */
    public $imageRoute;

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
            $filename = $this->getFileName($image);
            \array_push($files, $this->getImagePath() . '/' . $filename);
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
        $image->storeAs($this->getImagePath(), $newName);

        return route($this->imageRoute, ['image' => $newName], false);
    }
}