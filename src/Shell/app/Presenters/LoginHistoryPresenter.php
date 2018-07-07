<?php
namespace App\Presenters;

use App\Models\LoginHistory;

class LoginHistoryPresenter {

    public $loginHistory;

    public function __construct (LoginHistory $loginHistory)
    {
        $this->loginHistory = $loginHistory;
    }

    public function toModel($params)
    {

        if($params==null){
            return null;
        }else{
            
            $this->loginHistory->user_id = $params->user_id;
            $this->loginHistory->login_at = $params->login_at;
            $this->loginHistory->mac_address = $params->mac_address;
            $this->loginHistory->ip_adress = $params->ip_adress;
            return $this->loginHistory;
            
        }
    }

    public function toPresenter($params)
    {

    }
    
}