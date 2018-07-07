<?php
namespace App\Repositories;

use App\Interfaces\IUserRoleInterface;
use App\Presenters\UserRolePresenter;
use App\Models\UserRole;


class UserRoleRepository extends CrudRepository implements IUserRoleInterface {
    
    public function __construct (UserRolePresenter $userRolePresenter, UserRole $userRoleModel)
    {
        $this->presenter = $userRolePresenter;
        $this->model = $userRoleModel;
    }

}
