<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ParentModel;


class LoginHistory extends ParentModel 
{
    protected $table = 'login_history';

    public $timestamps = false;
    
    protected $fillable = [
        'user_id', 'login_at', 'mac_address', 'ip_address'
    ];

	public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}