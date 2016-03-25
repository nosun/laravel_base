<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use DB;
use Log;

class SiteBase extends Model
{

    public function formatCondition($query,$condition){
        if($condition){
            foreach($condition as $key => $value){
                $query = $query->where($key,$value);
            }
        }
        return $query;
    }
}