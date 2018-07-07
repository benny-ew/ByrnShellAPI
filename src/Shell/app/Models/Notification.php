<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ParentModel;

class Notification extends ParentModel 
{
    protected $table = 'notifications';
    
    public $timestamps = false;
    
    protected $fillable = [
        'content','user_id', 'type', 'read_at'
    ];

    protected $hidden = [
        'deleted_at', 'deleted_by'
    ];

	public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
