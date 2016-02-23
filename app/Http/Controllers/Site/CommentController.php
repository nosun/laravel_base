<?php namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\BaseController;

class CommentController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function uploadComments()
	{
		$title  = '上传评论';
		$is_nav = 'uploadComments';
		return view('site.uploadComments',array('title'=>$title,'is_nav' => $is_nav));
	}

	public function doUploadComments(Request $request){

	}
}
