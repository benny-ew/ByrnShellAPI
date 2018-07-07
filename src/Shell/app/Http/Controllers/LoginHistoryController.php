<?php 
namespace App\Http\Controllers;

use App\Interfaces\ILoginHistoryInterface;

class LoginHistoryController extends CrudController 
{

    public function __construct (ILoginHistoryInterface $loginHistory)
    {

        $this->repository = $loginHistory;
        $this->arrayValidation =  [];
    }

}