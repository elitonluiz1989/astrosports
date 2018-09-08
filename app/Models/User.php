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

    /**
     * Gets the user role relationship
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function role()
    {
        return $this->hasOne('App\Models\UserRole', 'id', 'role_id');
    }
    
    /**
     * Set username attribute to lowercase
     * 
     * @param string $value Value property
     * 
     * @return void
     */
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = strtolower($value);
    }
    
    /**
     * Encrypt user password
     * 
     * @param string $value Value property
     * 
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
