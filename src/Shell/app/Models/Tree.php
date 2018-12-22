<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ParentModel;

class Tree extends ParentModel
{
    protected $table = 'trees';
    public $timestamps = false;
    
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'created_at','created_by','deleted','deleted_at', 'deleted_by'
    ];

	public function role()
    {
        return $this->hasMany('App\Models\Role');
    }
}
