<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table ='sites';
    protected $fillable =['name'];

    public function test(){
        dd($this->connection);
    }
}
