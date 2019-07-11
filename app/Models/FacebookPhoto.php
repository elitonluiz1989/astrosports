<?php

namespace App\Models;

use App\Models\Abstracts\FacebookData;

class FacebookPhoto extends FacebookData
{
    /**
     * @var bool
     */
    public $legacy;

    /**
     * @return string
     */
    protected function getAltAttribute() {
        $name = $this->name ?? $this->id;
        return 'Foto ' . $name;
    }

    protected function getLinkAttribute()
    {
        if (isset($this->link)) {
            return $this->link;
        } else {
            // It's a album
            $url = config('photos.url.album') . $this->id;

            return $this->legacy ? $url . '?legacy=true' : $url;
        }
    }
}