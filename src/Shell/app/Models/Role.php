<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ParentModel;

class Role extends ParentModel
{
    protected $table = 'roles';

    public $timestamps = false;
    
    protected $fillable = [
        'rolename','tree_id', 'access'
    ];

    protected $hidden = [
        'created_at','created_by','deleted','deleted_at', 'deleted_by'
    ];
    
	public function userRole()
    {
        return $this->hasMany('App\Models\UserRole');
    }

    public function tree(){
        return $this->belongsTo('App\Models\Tree');
    }
}
