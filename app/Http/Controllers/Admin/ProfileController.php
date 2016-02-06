<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use \Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class ProfileController extends BaseController {

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
            $title = '个人信息';
            return view('admin.profile',array('title'=>$title,'user'=>$user));
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