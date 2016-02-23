<?php namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\BaseController;
use App\Helpers\AJAX;
use App\Modules\TermModule;

class TermController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
        $title  = 'Term Search';
		$is_nav = 'term';
		$list   = array();
		return view('site.term',array('title'=>$title,'is_nav' => $is_nav,'list' => $list));
	}

	public function termSearchByUrl(Request $request){
		$url        = $request['url'];
		$connection = getSiteName(getDomain($url));
		$path_alias = getUri($url);

		if(empty($connection) || empty($path_alias)){
			return AJAX::argumentError();
		}

		$termModule = new TermModule($connection);
		$result = $termModule->getTermInfo(array('path_alias' => $path_alias));

		if(count($result)>0){
			return AJAX::success(array('info'=>$result));
		}else{
			return AJAX::notExist();
		}
	}
}
