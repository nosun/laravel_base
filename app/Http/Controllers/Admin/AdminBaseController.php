<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Cache;

class AdminBaseController extends Controller {

    /*
     * the login info of administrator
     *
     */

    protected $admin;

    /*
     * the level of the administrator, 0 is super admin,
     * other is company admin,the super company_id is 0。
     *
    */


    public function __construct()
    {

    }

}