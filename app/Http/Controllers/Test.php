<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Site\Term;
use App\Models\Site;

class Test extends Controller
{
    public function index(){
        $sites = Site::where('status',1)->get();
        $str = '';
        foreach($sites as $site){
            $str.= "'$site->db_name' => [". "<br />".
                "'driver'  =>  'mysql',". "<br />".
                "'host'    =>  '".$site->db_ip."',"."<br />".
                "'database' => '".$site->db_name."',"."<br />".
                "'username' => '".$site->db_user."',"."<br />".
                "'password' => '".$site->db_pass."',"."<br />".
                "'charset'  => 'utf8',"."<br />".
                "'collation'=> 'utf8_unicode_ci',"."<br />".
                "'prefix'   => '',"."<br />".
                "'strict'   => false"."<br />".
                "],"."<br />"."<br />"."<br />";
        }

        //echo $str;

    }
}