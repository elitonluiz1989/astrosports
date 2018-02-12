<?php

namespace App\Models;

use App\Models\Abstracts\FacebookData;

class FacebookPhoto extends FacebookData
{
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
            return config('photos.url.album') . $this->id;
        }
    }
}