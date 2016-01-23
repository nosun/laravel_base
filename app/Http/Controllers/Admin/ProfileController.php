<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class ProfileController extends AdminBaseController {

    /**
     * Update the user's profile.
     *
     * @return Response
     */
    public function show(Request $request)
    {
        if ($request->user())
        {
            $user = $request->user();
            $email = $user->email;
            $company_id = $user->company_id;
            $product = Product::where('company_id',$company_id)->get();
            $data['product_num'] = count($product);

            $products =array();
            foreach($product as $row){
                $products[] = $row->product_id;
            }

            $data['device_num']  = DB::table('yun_device')->whereIn('product_id', $products)->count();
            $app = App::where('company_id','=',$company_id)->get();
            $apps =array();
            foreach($app as $row){
                $apps[] = $row->app_id;
            }

            $data['user_num']  = DB::table('yun_user')->whereIn('app_id', $apps)->count();

            $logtime = DB::table('yun_admin_log')->where('login_email','=',$email)->where('status','=',1)->orderby('login_time','desc')->limit(1)->get();
            foreach($logtime as $v){
                $data['login_time'] = $v->login_time;
            }

            $title = '个人信息';
            return view('admin.profile',array('title'=>$title,'data'=>$data,'user'=>$user));
        }
    }
    /**
     * Update the user's profile.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        if ($user)
        {
            if (!empty($data['password'])){
                $data['password'] = bcrypt($data['password']);
            }

            $user->update($data);
            $msg = '修改密码成功';
            $code = 200;
        }else{
            $code = 403;
            $msg = '修改密码失败';
        }

        $msg =array('msg' => $msg ,'code' => $code);
        return json_encode($msg);

    }


}