<?php
namespace App\Interfaces;

interface IUserInterface extends ICrudInterface {
    public function checkOldPassword($params);
    public function checkNewPassword($params);
    //public function login ($params);
}