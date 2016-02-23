<?php namespace App\Modules;

use App\Models\Site\Term;

class TermModule extends BaseModule
{

    public function __construct($connection){
        parent::__construct($connection);
    }

    public function getTermInfo($condition){
        $term = new Term();
        $term->setConnection($this->connection);
        $result = self::formatCondition($term->newQuery(),$condition)->get();
        return $result;
    }




}