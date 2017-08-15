<?php

namespace App\Models;

use App\Models\Abstracts\TeamBaseAbstract;

class Players extends TeamBaseAbstract
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo('App\Models\PlayersPositions', 'id');
    }
}
