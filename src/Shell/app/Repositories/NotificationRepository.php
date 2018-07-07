<?php
namespace App\Repositories;

use App\Interfaces\INotificationInterface;
use App\Presenters\NotificationPresenter;
use App\Models\Notification;


class NotificationRepository extends CrudRepository implements INotificationInterface {
    
    public function __construct (NotificationPresenter $notificationPresenter, Notification $notificationModel)
    {
        $this->presenter = $notificationPresenter;
        $this->model = $notificationModel;
    }

}
