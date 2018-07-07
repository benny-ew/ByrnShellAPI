<?php
namespace App\Repositories;

use App\Interfaces\IUserInterface;
use App\Presenters\UserPresenter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends CrudRepository implements IUserInterface {
    
    public function __construct (UserPresenter $userPresenter, User $userModel)
    {
        $this->presenter = $userPresenter;
        $this->model = $userModel;
    }

    public function checkOldPassword($params){
        //$id=$params->get('id');

        //$params = new Request(); 

        $update['filter']['id'] = $params->get('id');
        $update['type'] = 'ONE';

        $params->merge($update);

        $userData = $this->read($params);

        if (Hash::check($params->old_password, $userData->password)) {
            return true;
        }else{
            return false;
        }

    }

    public function checkNewPassword($params){
        if ($params->new_password == $params->confirmed_new_password){
            return true;
        }else{
            return false;
        }
    }
    
    public function login ($params)
    {

    }

}
