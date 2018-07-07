<?php
namespace App\Interfaces;

interface ILoginHistoryInterface extends ICrudInterface {
    public function setHistory($params);
}