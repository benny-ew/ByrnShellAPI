<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ParentModel;


class UserRole extends ParentModel
{
    protected $table = 'user_role';
    
    public $timestamps = false;
    
    protected $fillable = [
        'user_id','role_id'
    ];

    protected $hidden = [
        'created_at','created_by','deleted','deleted_at', 'deleted_by'
    ];
	public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function roles(){
        return $this->belongsTo('App\Models\Role');
    }
}
