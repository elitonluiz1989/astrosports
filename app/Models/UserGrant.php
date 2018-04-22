<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGrant extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->hasMany('App\Models\User', 'grant', 'id');
    }
}
