<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable =['name','display_name','description'];

    public function users()
    {
        return $this->belongsToMany('Models\Admin','role_user','user_id','role_id');
    }
}
