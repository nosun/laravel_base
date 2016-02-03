<?php

namespace App\Models;

use App\Models\SiteBase;

class Term extends SiteBase
{

    protected $table ='terms';
    protected $primaryKey ='tid';
    protected $connection = '';


}
