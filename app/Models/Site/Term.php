<?php

namespace App\Models\Site;
use DB;

class Term extends SiteBase
{
    protected $table ='terms';
    protected $primaryKey ='tid';

    public function getTermInfo($condition){
        $db  = Db::connection($this->connection)->table($this->table);
        $db  = $this->formatCondition($db,$condition);
        $res = $db->first();
        return $res;
    }

}
