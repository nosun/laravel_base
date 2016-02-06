<?php namespace App\Helpers;

use Illuminate\Support\Facades\Redis;

class ConnectionHelper
{
    public static function getConnection(){
       return Redis::get('mysql_current_connection');
    }

    public static function setConnection($conn){
        Redis::set('mysql_current_connection',$conn);
    }

}