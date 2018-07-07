<?php
namespace App\Repositories;

use App\Interfaces\IRoleInterface;
use App\Presenters\RolePresenter;
use App\Models\Role;


class RoleRepository extends CrudRepository implements IRoleInterface {
    
    public function __construct (RolePresenter $rolePresenter, Role $roleModel)
    {
        $this->presenter = $rolePresenter;
        $this->model = $roleModel;
    }

}
