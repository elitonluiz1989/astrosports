<?php

namespace App\Models;

use App\Models\Abstracts\ImageBaseAbstract;
use Carbon\Carbon;

class News extends ImageBaseAbstract
{
    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        $titleTreated =  $this->attributes['id'] . \str_replace(   ' ', '-', \substr($this->title, 0, 50));
        return 'noticias/' . $this->attributes['id'] . '_' . \urldecode($titleTreated);
    }

    /**
     * @param $value
     * @return string
     */
    public function getTextAttribute($value)
    {
        return \html_entity_decode($value);
    }

    /**
     * @return string
     */
    public function getPublishedAtAttribute()
    {
        $date = $this->attributes['updated_at'] ?? $this->attributes['created_at'];

        $date = Carbon::parse($date);

        return $date->format('d F Y - H:i');
    }

    /**
     * @return string
     */
    public function getPublishedByAttribute()
    {
        return 'Escrito por <strong>' . $this->attributes['author'] . '</strong> em '. $this->published_at;
    }

    /**
     * @return string
     */
    protected function getImgName()
    {
        return $this->attributes['cover'];
    }

    /**
     * @return array
     */
    protected function getDefaultImgSize()
    {
        return config('news.cover');
    }
}
