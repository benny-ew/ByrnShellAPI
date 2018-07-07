<?php 
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request as Request;
use App\Interfaces\IUserInterface;
use Firebase\JWT\JWT;

class UserController extends CrudController 
{

    public function __construct (IUserInterface $user)
    {

        $this->repository = $user;

        $this->arrayValidation =  [
            'name' => 'required',
            'username' => 'required|unique:shelldb.public.users',
            'password' => 'required',
            'email' => 'required|unique:shelldb.public.users'
        ];
    }

    public function registration(Request $request)
    {
        return $this->create($request);
    }

    public function register(Request $request)
    {

        $token = JWT::decode($request->token, env('JWT_SECRET'),['HS256']);

        $update = [];
        $update['data']['id'] = intval($request->data['id']);
        $update['data']['registered'] = true;
        $update['data']['registered_at'] = 'NOW()';
        $update['data']['registered_by'] = $token->nam;

        $request->merge($update);

        return $this->update($request);
    }

    public function changePassword(Request $request)
    {
        $token = JWT::decode($request->token, env('JWT_SECRET'),['HS256']);

        if ($this->repository->checkOldPassword($request)){
            if ($this->repository->checkNewPassword($request)){
                
                $update = [];
                $update['data']['id'] = intval($request->id);
                $update['data']['password'] = bcrypt($request->new_password);
                $update['data']['updated_at'] = 'NOW()';
                $update['data']['updated_by'] = $token->nam;

                $request->merge($update);
                $this->update($request);

                return response()->json(['success'=>true], 200);
            }else{
                return response()->json(['success'=>false,'message'=>'Password baru tidak sesuai'], 400);
            }
        }else{
            return response()->json(['success'=>false,'message'=>'Password salah'], 400);
        }
         
    }

}