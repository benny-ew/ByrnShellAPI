<?php 
namespace App\Http\Controllers;

use App\Interfaces\ITreeInterface;

class TreeController extends CrudController 
{

    public function __construct (ITreeInterface $tree)
    {

        $this->repository = $tree;
        $this->arrayValidation =  [];
    }

}