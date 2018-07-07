<?php
namespace App\Presenters;

use App\Models\Role;

class RolePresenter {

    public $role;

    public function __construct (Role $role)
    {
        $this->role = $role;
    }

    public function toModel($params)
    {

        if($params==null){
            return null;
        }else{
            
            $this->role->rolename = $params->rolename;
            $this->role->access =  $params->access;
            $this->role->tree_id = $params->tree_id;
    
            return $this->role;
            
        }
    }

    public function toPresenter($params)
    {

    }
    
}