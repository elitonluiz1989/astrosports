<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'grant_id'];

    public function grant() {
        return $this->hasOne('App\Models\UserGrant', 'id', 'grant_id');
    }
}
