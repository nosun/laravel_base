<?php namespace App\Models\Site;

use DB;

class FiveStar extends SiteBase
{
    protected $table ='widget_fivestars';

    public function addCommentFiveStar($commentFiveStar){
       return DB::connection($this->connection)->table($this->table)->insert($commentFiveStar);
    }

}
