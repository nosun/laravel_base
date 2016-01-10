<?php namespace Yun\Http\Controllers\Admin;

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

    protected $company;

    public function __construct()
    {
        $this->admin = Auth::user();
        $this->company = $this->admin->company_id;

        // Company
        if (!Cache::has('CacheCompany')) {
            $company = array();
            $companys = DB::table('yun_company')->select('id', 'name')->get();
            foreach ($companys as $row) {
                $company[$row->id] = $row->name;
            }
            Cache::forever('CacheCompany', $company);
        } else {
            $company = Cache::get('CacheCompany');
        }

        // APP
        if (!Cache::has('CacheApp')) {
            $app = array();
            $apps = DB::table('yun_app')->select('app_id', 'app_name')->get();
            foreach ($apps as $row) {
                $app[$row->app_id] = $row->app_name;
            }
            Cache::forever('CacheApp', $app);
        } else {
            $app = Cache::get('CacheApp');
        }

        // Product Model
        if (!Cache::has('CacheProductModel')) {
            $productModel = array();
            $models = DB::table('yun_product_model')->select('model_id', 'model_name')->get();
            foreach ($models as $row) {
                $productModel[$row->id] = $row->model;
            }
            Cache::forever('CacheProductModel', $productModel);
        } else {
            $productModel = Cache::get('CacheProductModel');
        }

        // Product
        if (!Cache::has('CacheProduct')) {
            $product = array();
            $products = DB::table('yun_product')->select('product_id', 'model_id')->get();
            foreach ($products as $row) {
                $product[$row->product_id] = $productModel[$row->model_id];
            }
            Cache::forever('CacheProduct', $product);
        } else {
            $product = Cache::get('CacheProduct');
        }

        // Protocol
        if (!Cache::has('CacheProtocol')) {
            $protocol = array();
            $protocols = DB::table('yun_protocol')->select('protocol_id', 'protocol_version')->get();
            foreach ($protocols as $row) {
                $protocol[$row->protocol_id] = $row->protocol_version;
            }
            Cache::forever('CacheProtocol', $protocol);
        } else {
            $protocol = Cache::get('CacheProtocol');
        }

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
            $configs = DB::table('yun_admin_config')->orderby('updatetime', 'desc')->limit(1)->get();
            $config = array(
                'imgpath' => $configs[0]->img_down,
                'apkpath' => $configs[0]->apk_down,
                'binpath' => $configs[0]->bin_down,
                'page' => $configs[0]->pagenow
            );
            Cache::forever('CacheConfig', $config);
        } else {
            $config = Cache::get('CacheConfig');
        }

        $data['company']  = $company;
        $data['product']  = $product;
        $data['protocol'] = $protocol;
        $data['productModel'] = $productModel;
        $data['app'] = $app;
        $data['admin'] = $this->admin;
        $data['role'] = $role;
        $this->config = $config;
        view()->share('u_data', $data);
    }

}