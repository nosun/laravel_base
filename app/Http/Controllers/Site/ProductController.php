<?php namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\BaseController;
use App\Helpers\AJAX;
use App\Modules\ProductModule;

class ProductController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index()
	{
        $title  = '商品管理';
		$is_nav = 'product';
		$list   = array();
		return view('site.product',array('title'=>$title,'is_nav' => $is_nav,'list' => $list));
	}

	public function productSearchByURL(Request $request){
		$url        = $request['url'];
		$connection = getSiteName(getDomain($url));
		$sn = getSn($url);

		if(empty($connection) || empty($sn)){
			return AJAX::argumentError();
		}

		$termModule = new ProductModule($connection);
		$result = $termModule->getProductInfo(array('sn' => $sn));

		if(count($result)>0){
			return AJAX::success(array('info'=>$result));
		}else{
			return AJAX::notExist();
		}
	}

}
