<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ParentModel;


class UserRole extends ParentModel
{
    protected $table = 'user_role';
    
    public $timestamps = false;
    
    protected $fillable = [
        
    ];

    protected $hidden = [
        'deleted_at', 'deleted_by'
    ];
	public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
