<?php 
namespace App\Http\Controllers;

use App\Interfaces\IUserRoleInterface;

class UserRoleController extends CrudController 
{

    public function __construct (IUserRoleInterface $userrole)
    {

        $this->repository = $userrole;
        $this->arrayValidation =  [];
    }

}