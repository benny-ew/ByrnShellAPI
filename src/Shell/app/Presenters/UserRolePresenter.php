<?php
namespace App\Presenters;

use App\Models\UserRole;

class UserRolePresenter {

    public $userRole;

    public function __construct (UserRole $userRole)
    {
        $this->userRole = $userRole;
    }

    public function toModel($params)
    {

        if($params==null){
            return null;
        }else{
            
            $this->userRole->user_id = $params->user_id;
            $this->userRole->role_id =  $params->role_id;


            return $this->userRole;
            
        }
    }

    public function toPresenter($params)
    {

    }
    
}