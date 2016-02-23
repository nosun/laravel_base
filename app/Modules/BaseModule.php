<?php namespace App\Modules;


class BaseModule
{

    public $connection;
    public function __construct($connection){
        $this->connection = $connection;
    }

    static function formatCondition($query,$condition){
        if($condition){
            foreach($condition as $key => $value){
                $query = $query->where($key,$value);
            }
        }
        return $query;
    }

}