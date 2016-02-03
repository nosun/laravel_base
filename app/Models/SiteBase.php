<?php

namespace App\Models;

use Eloquent;
use App\Models\Site;

class SiteBase extends Eloquent
{

    public function test(){
       dd($this->connection);
    }

}