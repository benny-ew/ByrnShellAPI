<?php
namespace App\Presenters;

use App\Models\User;

class UserPresenter {

    public $user;

    public function __construct (User $user)
    {
        $this->user = $user;
    }

    public function toModel($params)
    {

        if($params==null){
            return null;
        }else{
            
            $this->user->name = $params->name;
            $this->user->password =  bcrypt($params->password);
            $this->user->username = $params->username;
            $this->user->email = $params->email;
    
            return $this->user;
            
        }
    }

    public function toPresenter($params)
    {

    }
    
}