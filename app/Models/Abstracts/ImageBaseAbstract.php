<?php

namespace App\Models\Abstracts;

use Illuminate\Database\Eloquent\Model;

abstract class ImageBaseAbstract extends Model
{
    /**
     * @var string
     */
    protected $imgSrc = 'storage/photos/';

    /**
     * @return string
     */
    public function getSourceAttribute()
    {
        return $this->imgSrc . $this->definingImg();
    }

    /**
     * @return string
     */
    public function getAltAttribute()
    {
        if (isset($this->attributes['description'])) {
            return substr($this->attributes['description'], 0, 100);
        } else {
            return 'Imagem ' . \ucfirst($this->definingImg()) . ' não carregada.';
        }
    }

    /**
     * @return string
     */
    abstract protected function definingImg();
}