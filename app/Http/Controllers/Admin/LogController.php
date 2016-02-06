<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\AdminLog;

class LogController extends BaseController {

	public function index()
	{
        $list = AdminLog::select('*')->orderby('log_id','desc')->paginate(15);
        $title = '管理员登录日志';
        return view('admin.adminLog',array('list'=>$list,'title'=>$title));
	}

    public function del(){
        AdminLog::where('time','<',date('Y-m-d H:i:s',time()-86400*30))->delete();
        $code = 200;
        $msg = json_encode(array('msg'=>$code));
        return $msg;
    }

}
