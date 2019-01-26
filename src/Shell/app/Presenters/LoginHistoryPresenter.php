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
            
            $this->loginHistory->user_id = $params['user_id'];
            $this->loginHistory->login_at = $params['login_at'];
            $this->loginHistory->expiration_date = $params['expiration_date'];
            $this->loginHistory->ip_address = $params['ip_address'];
            $this->loginHistory->created_at = $params['created_at'];
            $this->loginHistory->created_by = $params['created_by'];
            return $this->loginHistory;
            
        }
    }

    public function toPresenter($params)
    {

    }
    
}