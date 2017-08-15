<?php

namespace App\Models\Abstracts;

class TeamBaseAbstract extends ImageBaseAbstract
{
    /**
     * @return string
     */
    protected function definingImg()
    {
        $cover = config('about.cover');
        $resize = '?w=' . $cover['width'] . '&h=' . $cover['height'];
        $img = $this->attributes['avatar'] ?? config('about.team.img');

        return $img . $resize;
    }
}