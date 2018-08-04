<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'name', 'avatar', 'password', 'role'
    ];


    protected $hidden = [
        'password', 'remember_token'
    ];

    public function roles()
    {
        return $this->hasOne('App\Models\UserRole', 'id', 'role');
    }
}
