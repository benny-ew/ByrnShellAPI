<?php 
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request as Request;
use App\Interfaces\IUserInterface;
use Firebase\JWT\JWT;

class CrudController extends BaseController 
{

    protected $repository;
    protected $arrayValidation=array();
    protected $operator;

    public function create(Request $request)
	{
        $validation = \Validator::make($request->all(),$this->arrayValidation);

        if ( $validation->fails() ) {
            return response()->json($validation->messages());
        }else{
            
            
            $result = $this->repository->create($request);

            if ($result>0){
                return response()->json([
                    'success' => true
                ], 200);
            }else{
                return response()->json(['success'=>false,'message'=>'Tidak berhasil menyimpan data'], 500);
            }
            
        }
        
    }
    
    public function read(Request $request)
    {
        $result = $this->repository->read($request);
        if ($result->count()>0){
            return response()->json([
                $result
            ], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'Tidak menemukan data yang sesuai kriteria'], 204);
        }
    }

    public function update(Request $request)
    {

        $result = $this->repository->update($request);

        if ($result>0){
            return response()->json([
                'success' => true
            ], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'Tidak berhasil mengupdate data'], 400);
        }
    }

    public function delete(Request $request)
    {
        $result = $this->repository->delete($request);
        if ($result>0){
            return response()->json([
                'success' => true
            ], 200);
        }else{
            return response()->json(['success'=>false,'message'=>'Tidak berhasil menghapus data'], 400);
        }
    }

}