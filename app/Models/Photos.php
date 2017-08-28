<?php

namespace App\Models;

use App\Models\Abstracts\PhotoBaseAbstract;

class Photos extends PhotoBaseAbstract
{
    /**
     * Photos album
     * Set the relationship with Album model
     */
    public function album()
    {
        return $this->belongsTo('App\Models\Albums', 'id');
    }
}
