<?php 
namespace App\Http\Controllers;

use App\Interfaces\INotificationInterface;

class NotificationController extends CrudController 
{

    public function __construct (INotificationInterface $notification)
    {

        $this->repository = $notification;
        $this->arrayValidation =  [];
    }

}