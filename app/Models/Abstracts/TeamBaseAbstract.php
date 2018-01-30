<?php

namespace App\Models\Abstracts;

class TeamBaseAbstract extends ImageBaseAbstract
{
    /**
     * @return string
     */
    protected function getImgName()
    {
        return $this->attributes['avatar'] ?? config('about.team.img');
    }

    /**
     * @return array
     */
    protected function getDefaultImgSize()
    {
        return config('about.cover');
    }
}