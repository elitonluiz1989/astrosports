<?php

namespace App\Models;

use App\Models\Abstracts\ImageBaseAbstract;

class Advertising extends ImageBaseAbstract
{
    /**
     * @param  string $value
     * @return string
     */
    public function getUrlAttribute($value)
    {
        return $value ?? '#';
    }

    /**
     * @return string|null
     */
    public function getTargetAttribute()
    {
        if (null == $this->attributes['url']) {
            return null;
        } else {
            return 'target="__blank"';
        }
    }

    /**
    * @return string
    */
    protected function definingImg()
    {
        $resize = config('advertising.img');
        $img = $this->attributes['img'] . '?w=' . $resize['width'] . '&h=' . $resize['height'];

        return $img;
    }
}
