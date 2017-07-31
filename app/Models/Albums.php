<?php

namespace App\Models;


class Albums extends PhotoBaseAbstract
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Models\Photos', 'id');
    }
}
