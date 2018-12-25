<?php
namespace App\Repositories;

use App\Interfaces\ICrudInterface;
use Firebase\JWT\JWT;

abstract class CrudRepository implements ICrudInterface {
    
    public $presenter;
    public $model;

    private $filters;

    private function filter($params)
    {
        $arrayFilter=[];

        if($params->has('filter')){
            foreach($params->filter as $key => $value){
                array_push($arrayFilter,[$key,'=',$value]);
                $this->filters.='&filter_text['.$key.']='.$value;
            }
        }

        if ($params->has('filter_text')){
            foreach($params->filter_text as $key => $value){
                array_push($arrayFilter,[$key,'LIKE','%'.$value.'%']);
                $this->filters.='&filter_text['.$key.']='.$value;
            }
        }
        if ($params->has('filter_eq')) {
            foreach($params->filter_eq as $key => $value){
                array_push($arrayFilter,[$key,'=',$value]);
                $this->filters.='&filter_eq['.$key.']='.$value;
            }
        }
        if ($params->has('filter_neq')) {
            foreach($params->filter_neq as $key => $value){
                array_push($arrayFilter,[$key,'<>',$value]);
                $this->filters.='&filter_neq['.$key.']='.$value;
            }
        }
        if ($params->has('filter_less')) {
            foreach($params->filter_less as $key => $value){
                array_push($arrayFilter,[$key,'<',$value]);
                $this->filters.='&filter_less['.$key.']='.$value;
            }
        }
        if ($params->has('filter_more')) {    
            foreach($params->filter_more as $key => $value){
                array_push($arrayFilter,[$key,'>',$value]);
                $this->filters.='&filter_more['.$key.']='.$value;
            }
        }
        return $arrayFilter;
    } 

    public function create($params)
    {

        $model = $this->presenter->toModel($params);

        if (isset($params->token)){
            $token = JWT::decode($params->token, env('JWT_SECRET'),['HS256']);
            $model->created_by = $token->nam; 
        }
        $model->created_at ='NOW()'; 

        return $model->save();
    }

    /*------------------------------------------------------------------------------------------------------
    param Type : 
    ALL, 
    ALL_INCLUDE_DELETED, 
    ONE, 
    PAGINATED (pageSize optional), 
    FILTERED (filter[field_name], filter_less[field_name], filter_more[field_name], filter_neq[field_name])
    SORTED (sort[field_name] ASC or DESC) (support multi sort)
    PAGINATED_FILTERED, 
    PAGINATED_SORTED, 
    PAGINATED_FILTERED_SORTED
    ------------------------------------------------------------------------------------------------------*/
    public function read($params)
    {
        
        if ($params->has('pageSize')) {
            $pageSize = $params->pageSize;
        }else{
            $pageSize = env('DEFAULT_PAGINATE');
        }

        switch ($params->type) {
            case 'ALL':
                $result = $this->model->get();
                break;

            case 'ALL_INCLUDE_DELETED':
                $result = $this->model->withoutGlobalScope('deleted')->get();
                break;

            case 'ONE':
                $result = $this->model->where($this->filter($params))->first();
                break;

            case 'PAGINATED':
                $result = $this->model->paginate($pageSize)
                    ->withPath($params->url().'?token='.$params->token.'&type=PAGINATED');
                break;

            case 'FILTERED':
                $result = $this->model->where($this->filter($params))->get();
                break;

            case 'SORTED':
                $model = $this->model->newQuery();
                foreach ($params->get('sort') as $column => $direction) {
                    $model->orderBy($column, $direction);
                }
                $result = $model->get();
                break;

            case 'PAGINATED_FILTERED':
                $result = $this->model->where($this->filter($params))->paginate($pageSize)
                    ->withPath($params->url().'?token='.$params->token.'&type=PAGINATED_FILTERED'.$this->filters);
            break;

            case 'PAGINATED_SORTED':
                $model = $this->model->newQuery();
                foreach ($params->get('sort') as $column => $direction) {
                    $model->orderBy($column, $direction);
                }
                $result = $model->paginate($pageSize)
                    ->withPath($params->url().'?token='.$params->token.'&type=PAGINATED_SORTED'.$this->filters)->get();
                break;

            case 'PAGINATED_FILTERED_SORTED':

                $model = $this->model->newQuery();
                foreach ($params->get('sort') as $column => $direction) {
                    $model->orderBy($column, $direction);
                }

                $result = $this->model->paginate($pageSize)
                    ->withPath($params->url().'?token='.$params->token.'&type=PAGINATED_FILTERED_SORTED'.$this->filters)->get();
                break;

            default:
                $result = null;
        }
        
        return $result;
    }

    public function update($params)
    {
        $updateData = $params->data;

        $token = JWT::decode($params->token, env('JWT_SECRET'),['HS256']);

        $updateData['updated_at']= 'NOW()' ;
        $updateData['updated_by']=$token->nam;

        return $this->model->where('id', $updateData['id'])->update($updateData);
    }

    public function delete($params)
    {
        $deleteData = $params->data;

        $token = JWT::decode($params->token, env('JWT_SECRET'),['HS256']);

        $deleteData['deleted']= true ;
        $deleteData['deleted_at']= 'NOW()' ;
        $deleteData['deleted_by']=$token->nam;

        return $this->model->where('id', $deleteData['id'])->update($deleteData);
    }
}