<?php namespace App\Modules;

use App\Models\Site\Product;

class ProductModule extends BaseModule
{

    public function __construct($connection){
        parent::__construct($connection);
    }

    public function getProductInfo($condition){
        $term = new Product();
        $term->setConnection($this->connection);
        $result = self::formatCondition($term->newQuery(),$condition)->get();
        return $result;
    }

}