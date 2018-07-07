<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use App\Models\ParentModel;

class User extends ParentModel implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    public $timestamps = false;

    protected $fillable = [
        'username','name', 'email','phone','theme'
    ];

    protected $hidden = [
        'password', 'registered_by', 'deleted_at', 'deleted_by'
    ];

    public function loginHistory()
    {
        return $this->hasMany('App\Models\LoginHistory');
    }

    public function notifications()
    {
        return $this->hasMany('App\Model\Notification');
    }

    public function userRole()
    {
        return $this->hasMany('App\Models\UserRole');
    }
}
