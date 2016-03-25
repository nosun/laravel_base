<?php namespace App\Models\Site;


use DB;
use Log;

class ProductsComment extends SiteBase
{
    protected $table ='products_comments';

    public function addProductComment($productComment){
        return DB::connection($this->connection)->table($this->table)->insert($productComment);
    }

}
