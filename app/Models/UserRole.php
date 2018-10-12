<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'grant_id'];

    public function users() {
        return $this->belongsTo('App\Models\User');
    }

    public function grant() {
        return $this->hasOne('App\Models\UserGrant', 'id', 'grant_id');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}
