<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function grants() {
        return $this->hasOne('App\Models\UserGrant', 'id', 'grant');
    }
}
