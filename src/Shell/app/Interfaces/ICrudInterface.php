<?php
namespace App\Interfaces;

interface ICrudInterface {
    function create($params);
    function read($params);
    function update($params);
    function delete($params);
}