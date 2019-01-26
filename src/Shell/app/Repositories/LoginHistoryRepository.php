<?php
namespace App\Repositories;

use App\Interfaces\ILoginHistoryInterface;
use App\Presenters\LoginHistoryPresenter;
use App\Models\LoginHistory;


class LoginHistoryRepository extends CrudRepository implements ILoginHistoryInterface {
    
    public function __construct (LoginHistoryPresenter $loginHistoryPresenter, LoginHistory $loginHistoryModel)
    {
        $this->presenter = $loginHistoryPresenter;
        $this->model = $loginHistoryModel;
    }

    public function setHistory($params){
        $model = $this->presenter->toModel($params);
        return $model->save();
    }

}
