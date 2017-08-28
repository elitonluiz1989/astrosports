<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayersPositions extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function player()
    {
        return $this->hasMany('App\Models\Players', 'id');
    }
}
