<?php 
namespace App\Http\Controllers;

use App\Interfaces\IRoleInterface;

class RoleController extends CrudController 
{

    public function __construct (IRoleInterface $role)
    {

        $this->repository = $role;
        $this->arrayValidation =  [];
    }

}