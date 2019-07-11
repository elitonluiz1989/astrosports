<?php

namespace App\Models\Abstracts;

use Illuminate\Database\Eloquent\Model;

abstract class ImageBaseAbstract extends Model
{
    /**
     * @var string
     */
    protected $folder;

    /**
     * @return string
     */
    public function getSourceAttribute()
    {
        return $this->folder ?
                route('storage.images.folder.view', [$this->folder, $this->setImg()]) :
                route('storage.images.view', $this->setImg());
    }

    /**
     * @return string
     */
    public function getAltAttribute()
    {
        if (isset($this->attributes['description'])) {
            return substr($this->attributes['description'], 0, 100);
        } else {
            return 'Imagem ' . \ucfirst($this->getImgName()) . ' não carregada.';
        }
    }

    /**
     * @return string
     */
    protected function setImgSize() {
        $defaultSize = $this->getDefaultImgSize();

        $width = $defaultSize['width'] ?? 100;
        $height = $defaultSize['height'] ?? 100;

        return '?w='. $width . '&h=' . $height;
    }

    /**
     * @return string
     */
    private function setImg() {
        $imgName = $this->getImgName();

        if (\strpos($imgName, 'http') !== false) {
            return $imgName;
        } else {
            return $imgName . $this->setImgSize();
        }
    }

    /**
     * @return string
     */
    abstract protected function getImgName();

    /**
     * @return array
     */
    abstract protected function getDefaultImgSize();
}