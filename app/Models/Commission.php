<?php

namespace App\Models;

use App\Models\Abstracts\TeamBaseAbstract;

class Commission extends TeamBaseAbstract
{
    protected $table = 'commission';

    protected $folder = 'photos';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\CommissionRoles', 'id');
    }
}
