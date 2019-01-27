<?php
namespace App\Repositories;

use App\Interfaces\IUserInterface;
use App\Presenters\UserPresenter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserRepository extends CrudRepository implements IUserInterface {
    
    public function __construct (UserPresenter $userPresenter, User $userModel)
    {
        $this->presenter = $userPresenter;
        $this->model = $userModel;
    }

    public function checkOldPassword($params){

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
    
    public function getRoleAccess($userId, $treeId){
        
        $query = sprintf('SELECT  MAX(c.access) as access
            FROM users a
            LEFT JOIN user_role b ON a.id=b.user_id
            JOIN roles c ON c.id=b.role_id
            LEFT JOIN trees d ON  d.id=c.tree_id
            WHERE a.id=%d AND d.id=%d',$userId, $treeId);
        
        $results=DB::select($query);

        foreach ($results as $result) {
            $value = $result->access;
        }

        return $value;
    }

}
