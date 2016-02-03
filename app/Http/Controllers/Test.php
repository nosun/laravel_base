<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Term;
use App\Models\Site;
use DB;
use Illuminate\Database\ConnectionResolver;

class Test extends Controller
{
    public function index(){
        $resolver = new ConnectionResolver();
        $resolver->setDefaultConnection('shirley');

        $a = new Term();
        //dd($a);
        dd($a::all());

//        $r =DB::connection('shirley')->select('select * from terms limit 10');
//
//        dd($r);
    }
}
