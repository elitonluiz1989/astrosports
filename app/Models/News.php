<?php

namespace App\Models;

use App\Models\Abstracts\ImageBaseAbstract;
use Carbon\Carbon;

class News extends ImageBaseAbstract
{
    public function getPublishedAtAttribute()
    {
        $date = $this->attributes['updated_at'] ?? $this->attributes['created_at'];

        $date = Carbon::parse($date);

        return $date->format('d F Y - H:s');
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
