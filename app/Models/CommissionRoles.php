<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionRoles extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commission()
    {
        return $this->hasMany('App\Models\Commission', 'id');
    }
}
