<?php
namespace App\Http\Controllers;

use Validator;
use Firebase\JWT\JWT;
use App\Models\User as User;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\ILoginHistoryInterface;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController 
{
    private $request;
    private $loginHistory;

    public function __construct(Request $request, ILoginHistoryInterface $loginHistory) {
        $this->request = $request;
        $this->loginHistory = $loginHistory;
    }
    /**
     * Create a new token.
     * 
     * @param  \App\User   $user
     * @return string
     */
    protected function jwt(User $user) {
        $payload = [
            'iss' => "byrnShell", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'nam' => $user->username, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() +  env('TOKEN_EXPIRATION') // Expiration time
        ];
        
        return JWT::encode($payload, env('JWT_SECRET'));
    } 
    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     * 
     * @param  \App\User   $user 
     * @return mixed
     */
    public function authenticate(User $user) {
        
        $this->validate($this->request, [
            'username'     => 'required',
            'password'  => 'required'
        ]);

        $ip = $this->request->ip();

        $user = User::where('username', $this->request->input('username'))->first();

        if (!$user) {
            return response()->json([
                'error' => 'Username does not exist.'
            ], 400);
        }

        if (!$user->registered){
            return response()->json([
                'error' => 'Username does not exist.'
            ], 400);
        }

        if (Hash::check($this->request->input('password'), $user->password)) {

            $this->loginHistory->setHistory([
                'user_id'=>$user->id,
                'login_at'=>'NOW()',
                'expiration_date'=>date("Y-m-d H:i:s", time() +  env('TOKEN_EXPIRATION')),
                'ip_address'=>$ip,
                'created_at'=>'NOW()',
                'created_by'=> $this->request->input('username')
            ]);

            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
        }
        // Bad Request response
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }
}
