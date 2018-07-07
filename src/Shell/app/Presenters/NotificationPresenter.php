<?php
namespace App\Presenters;

use App\Models\Notification;

class NotificationPresenter {

    public $notification;

    public function __construct (Notification $notification)
    {
        $this->notification = $notification;
    }

    public function toModel($params)
    {

        if($params==null){
            return null;
        }else{
            
            $this->notification->content = $params->content;
            $this->notification->type = $params->type;
            $this->notification->user_id = $params->user_id;
            return $this->notification;
            
        }
    }

    public function toPresenter($params)
    {

    }
    
}