<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Cache;

class BaseController extends Controller {

    /*
     * the login info of administrator
     *
     */

    protected $admin;

    public function __construct()
    {
        $this->init();
    }

    public function init(){

        $this->admin = Auth::user();

        // Role
        if (!Cache::has('CacheRole')) {
            $role = array();
            $roles = DB::table('roles')->select('id', 'display_name as name')->get();
            foreach ($roles as $row) {
                $role[$row->id] = $row->name;
            }
            Cache::forever('CacheRole', $role);
        } else {
            $role = Cache::get('CacheRole');
        }

        // Config
        if (!Cache::has('CacheConfig')) {
            $configs = DB::table('admin_config')->orderby('updatetime', 'desc')->limit(1)->get();
            $config = array(
                'imgpath' => $configs[0]->img_path,
                'page_size' => $configs[0]->page_size
            );
            Cache::forever('CacheConfig', $config);
        } else {
            $config = Cache::get('CacheConfig');
        }

        $data['admin'] = $this->admin;
        $data['role'] = $role;
        $this->config = $config;

        view()->share('u_data', $data);
    }

}