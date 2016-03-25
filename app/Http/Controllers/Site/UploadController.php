<?php namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Helpers\AJAX;
use App\Models\File;
use Config;
use Validator;
use Auth;

class UploadController extends BaseController {

	public function uploadFile(Request $request){
		$user = Auth::user();
		$type = $request->type;
		$file = $request->file('file');
		$ext  = strtolower($file->getClientOriginalExtension());
		$size = $file->getSize();

		$validator = Validator::make(
			[
				'file'      => $file,
				'extension' => $ext,
				'size'      => $size,
			],
			[
				'file'      => 'required',
				'extension' => 'required|in:csv',
				'size'      => 'max:100000'
			]
		);

		if($validator->fails()){
			//dd($validator->errors());
			return Ajax::info('file format error');
		}

		$destinationPath = Config::get('app.file_path') . '/' . date('Ym', time());
		$save_path = public_path() .'/'.$destinationPath;
		$file_name = md5($file->getClientOriginalName().time()) . '.' . $ext;

		if (!is_dir($save_path)) {
			mkdir($save_path, 755, true);
		}

		if ($file->move($save_path, $file_name)) {
			$url  = url($destinationPath . '/' . $file_name);
			$file = new File();
			$file->ext  = $ext;
			$file->type = $type;
			$file->name = $file_name;
			$file->path = $destinationPath . '/' . $file_name;
			$file->uid  = $user->id;
			$file->url  = $url;
			$file->size = $size;
			$file->created_at = time();
			$fid = $file->save();
			if($fid){
				return AJAX::success($result = array('url' => $url,'name' =>$file_name));
			}else{
				return AJAX::serverError();
			}
		} else {
			return AJAX::info('upload file error');
		}
	}
}
