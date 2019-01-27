<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request as Request;
use Firebase\JWT\JWT;

class Controller extends BaseController
{
    protected $treeId=1;
    protected $token;
    protected $request;

    public function __construct(Request $request){
        $this->token = JWT::decode($request->token, env('JWT_SECRET'),['HS256']);
    }

    public function shellAuthorize($minAuthorizedNumber){
        if ($this->accessNumber()==$minAuthorizedNumber) {
            return true;
        } else {
            return false;
        };
    }

    protected function accessNumber(){
        return $this->repository->getRoleAccess($this->token->sub,$this->treeId);
    }
}