<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ParentModel;


class LoginHistory extends ParentModel 
{
    protected $table = 'login_history';

    public $timestamps = false;
    
    protected $fillable = [
        'user_id', 'login_at', 'expiration_date', 'ip_address'
    ];

    protected $hidden = [
        'created_at','created_by','deleted','deleted_at', 'deleted_by'
    ];


	public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}