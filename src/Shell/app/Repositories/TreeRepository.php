<?php
namespace App\Repositories;

use App\Interfaces\ITreeInterface;
use App\Presenters\TreePresenter;
use App\Models\Tree;


class TreeRepository extends CrudRepository implements ITreeInterface {
    
    public function __construct (TreePresenter $treePresenter, Tree $treeModel)
    {
        $this->presenter = $treePresenter;
        $this->model = $treeModel;
    }

}
