<?php 
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request as Request;
use App\Interfaces\IUserInterface;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class UserController extends CrudController 
{
    public function __construct (Request $request, IUserInterface $user)
    {
        parent::__construct($request);

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
        $minAuthorizedNumber = 5;

        if ($this->shellAuthorize($minAuthorizedNumber)){
            $update = [];
            $update['data']['id'] = intval($request->data['id']);
            $update['data']['registered'] = true;
            $update['data']['registered_at'] = 'NOW()';
            $update['data']['registered_by'] = $this->token->nam;
            $request->merge($update);

            return $this->update($request);
        } else {
            return response()->json(['success'=>false,'message'=>'Tidak menjalankan fungsi ini'], 400);
        }
    }

    public function changePassword(Request $request)
    {
        $minAuthorizedNumber = 7;

        if ($this->shellAuthorize($minAuthorizedNumber) or ($this->token->sub == $request->id)){
            if ($this->repository->checkOldPassword($request)){
                if ($this->repository->checkNewPassword($request)){
                    $update = [];
                    $update['data']['id'] = intval($request->id);
                    $update['data']['password'] = Hash::make($request->new_password);
                    $update['data']['updated_at'] = 'NOW()';
                    $update['data']['updated_by'] = $this->token->nam;
    
                    $request->merge($update);
                    $this->update($request);
    
                    return response()->json(['success'=>true], 200);
                }else{
                    return response()->json(['success'=>false,'message'=>'Password baru tidak sesuai'], 400);
                }
            }else{
                return response()->json(['success'=>false,'message'=>'Password salah'], 400);
            }
        }else{
            return response()->json(['success'=>false,'message'=>'Tidak diperkenankan mengubah password user lain'], 400);
        }
        
         
    }

}