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
     * @param  string $value
     * @return string|null
     */
    public function getTargetAttribute($value)
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
        $rezise = config('advertising.img');
        $img = $this->attributes['img'] . '?w=' . $rezise['width'] . '&h=' . $rezise['height'];

        return $img;
    }
}
