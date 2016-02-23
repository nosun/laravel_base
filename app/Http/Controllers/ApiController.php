<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\AJAX;
use Illuminate\Support\Facades\Redis;
use App\Models\DeviceFile;
use Config;
use Validator;

class ApiController extends Controller
{
    public function uploadLog(Request $request){

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
                'extension' => 'required|in:log',
                'size'      => 'max:100000'
            ]
        );

        if($validator->fails()){
            //dd($validator->errors());
            return Ajax::info('file format error');
        }

        $destinationPath = Config::get('app.pclog_path') . '/' . date('Ym', time());
        $save_path = public_path() .'/'.$destinationPath;
        $file_name = md5($file->getClientOriginalName().time()) . '.' . $ext;

        if (!is_dir($save_path)) {
            mkdir($save_path, 755, true);
        }

        if ($file->move($save_path, $file_name)) {
            $url = url($destinationPath . '/' . $file_name);
            $file = new DeviceFile();
            $file->ext    = $ext;
            $file->name   = $file_name;
            $file->path   = $destinationPath . '/' . $file_name;
            $file->did    = $request->pc->id;
            $file->size   = $size;
            $file->created_at = time();
            $fid = $file->save();
            if($fid){
                return AJAX::success($result = array('url' => $url));
            }else{
                return AJAX::serverError();
            }
        } else {
            return AJAX::info('upload file error');
        }
    }

}
