<?php
namespace App\Presenters;

use App\Models\Tree;

class TreePresenter {

    public $tree;

    public function __construct (Tree $tree)
    {
        $this->tree = $tree;
    }

    public function toModel($params)
    {

        if($params==null){
            return null;
        }else{
            $this->tree->name = $params->name;
            // $this->tree->created_at = $params->created_at;
            // $this->tree->created_by = $params->created_by;
            return $this->tree;
            
        }
    }

    public function toPresenter($params)
    {

    }
    
}