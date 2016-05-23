<?php namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\BaseController;
use App\Models\Site;
use App\Helpers\AJAX;
use App\Models\File;
use App\Modules\CommentModule;
use Log;


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
		$sites  = Site::where('status',1)->get();
		return view('site.uploadComments',array('title'=>$title,'is_nav' => $is_nav,'sites' => $sites));
	}

	public function addComments(Request $request){
		$name  = $request->name;
		$end   = isset($request->end)?strtotime($request->end):time();
		$start = isset($request->start)?strtotime($request->start):($end-86400*180);
		$site  = isset($request->site)?$request->site:'';
		$mode  = isset($request->mode)?$request->mode:'';
		$f = $s =0;

		if(empty($name) || empty($site) || empty($mode)){
			return AJAX::argumentError();
		}

		$file = File::where(array('name' => $name))->first();

		if(empty($file) || empty($file->path)){
			return AJAX::notExist();
		}

		$list = $this->getFileContents($file->path);

		switch ($mode){
			case 'insertComments':
				$result = $this->checkCommentsFile($list,4);
				break;
			case 'insertCommentsWithTid':
				$result = $this->checkCommentsFile($list,5);
				break;
			default:
				$result['code'] = 500;
				$result['data'] = 'arguments error';
				break;
		}

		if($result['code'] != 200){
			return AJAX::badData(array('message' => $result['message']));
		}

		$commentModule = new CommentModule($site);
		foreach($list as $line){
			$comment_time = $this->getCommentRandTime($start,$end);
			$res = $commentModule->addCommentByLine($line,$comment_time,$mode);
			if($res['code'] != 200){
				Log::error($site.':'.$name.$res['message']);
				$f++;
				continue;
			}
			$s++;
		}
		return AJAX::success(array('success' => $s,'fail' => $f ));
	}

	protected function checkCommentsFile($list,$num){
		$count = count($list);
		$i = 0;
		$bad = '';
		foreach($list as $line){
			if (!empty($line)) {
				$items = explode("#", $line);
				if (count($items) != $num) {
					$bad = $line;
					Log::info($bad);
					break;
				}
			}
			$i++;
		}
		if($count-$i <=1){
			$message = "success count is $count, read line is $i";
			$code    = 200;
		}else{
			$message = "failed at line :". $bad;
			$code    = 500;
		};
		return array('code' =>$code,'message'=>$message);
	}

	protected function getFileContents($path){
		$file = trim(file_get_contents(public_path($path)),"\r\n");
		return explode(PHP_EOL,$file);
	}

	protected function getCommentRandTime($start,$end){
		return $start + rand(1,($end-$start));
	}
}
