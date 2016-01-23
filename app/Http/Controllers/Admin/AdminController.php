<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;

class AdminController extends AdminBaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $list = Admin::paginate($this->config['page']);
        $title = '用户管理';
		return view('admin.adminList',array('list'=>$list,'title'=>$title));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|max:255|unique:yun_admin',
            'email' => 'required|email|max:255|unique:yun_admin',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator);
        }

        Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'company_id' => $data['company_id'],
            'status' => $data['status']
        ]);

        if(!empty($data['roles'])){
            $user = Admin::where('name','=',$data['name'])->first();
            foreach ($data['roles'] as $role){
                $user->attachRole($role);
            }

        }

        $msg =array('msg' => '已成功添加');
        return json_encode($msg);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Request $request,$id)
	{
        //
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'max:255',
            'email' => 'max:255|email',
            'password' => 'min:6'
        ]);

        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator);
        }

        if (!empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }

        $user = Admin::findOrFail($id);
        $user -> update($data);

        $roles = $data['roles'];
        if(empty($roles)){
            $roles =array();
        }
        $user->roles()->sync($roles);

        $msg =array('msg' => '已成功更新');
        return json_encode($msg);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request,$id)
	{
		$self = $request->user();

        if ($self->id == $id){
            $code = 403;
        }else{
            Admin::destroy($id);
            $code = 200;
        }

        $msg = json_encode(array('msg'=>$code));
        return $msg;
	}

}
