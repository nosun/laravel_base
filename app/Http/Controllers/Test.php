<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Site\Term;

class Test extends Controller
{
    public function index(){

        $a = new Term();
        //$a->setCurrentConnection('shirley');
        $a->setConnection('shirley');
        $b = $a->newQuery()->where('visible','1')->get();
        dd($b);
    }
}
