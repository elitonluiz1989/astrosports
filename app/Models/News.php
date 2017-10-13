<?php

namespace App\Models;

use App\Models\Abstracts\ImageBaseAbstract;
use Carbon\Carbon;

class News extends ImageBaseAbstract
{
    public function getUrlAttribute()
    {
        $titleTreated =  $this->attributes['id'] . \str_replace(   ' ', '-', \substr($this->title, 0, 50));
        return 'noticias/' . $this->attributes['id'] . '_' . \urldecode($titleTreated);
    }

    public function getTextAttribute($value)
    {
        return \html_entity_decode($value);
    }

    public function getPublishedAtAttribute()
    {
        $date = $this->attributes['updated_at'] ?? $this->attributes['created_at'];

        $date = Carbon::parse($date);

        return $date->format('d F Y - H:i');
    }

    public function getPublishedByAttribute()
    {
        return 'Escrito por <strong>' . $this->attributes['author'] . '</strong> em '. $this->published_at;
    }

    /**
     * @return string
     */
    protected function definingImg()
    {
        if (\strpos($this->attributes['cover'], 'http') !== false) {
            return $this->attributes['cover'];
        } else {
            $cover = config('news.cover');
            return $this->attributes['cover'] . '?w=' . $cover['width'] . '&h=' . $cover['height'];
        }
    }
}
