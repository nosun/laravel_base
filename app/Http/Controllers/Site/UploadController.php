<?php namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\BaseController;
use App\Helpers\AJAX;
use App\Modules\ProductModule;

class UploadController extends BaseController {

	public function uploadComments()
	{
        $title  = '上传评论';
		$is_nav = 'uploadComments';
		return view('site.uploadComments',array('title'=>$title,'is_nav' => $is_nav));
	}

	public function doUploadComments(Request $request){
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
