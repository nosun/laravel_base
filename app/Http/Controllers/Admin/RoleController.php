<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use Validator;

class RoleController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$list = Role::paginate($this->config['page_size']);
		$title = '角色管理';
		return view('admin.roleList',array('title'=>$title,'list'=>$list));
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
			'name' => 'required|max:255|unique:roles',
			'display_name' => 'required|max:255'
		]);

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator);
		}
		Role::create([
			'name' => $data['name'],
			'display_name' => $data['display_name'],
			'description' => $data['description']
		]);

		$msg =array('msg' => '已成功添加');
		return json_encode($msg);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function pget($id)
	{

		$role = Role::where('id', '=', $id)->first();
		$list = Permission::all();
        $list = $this->buildTree($list);
        $perms= array();
		foreach($role->perms as $row){
			$perms[] = $row->id;
		}
		$title = '权限设置';
		return view('admin.permissionShow',array('title'=>$title,'list'=>$list,'perms'=>$perms,'id'=>$id));
	}

	/**
	 * Setting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function pset(Request $request, $id)
	{
        $role = Role::findOrFail($id);
        $perms = $request['permission'];
        if(empty($perms)){
            $perms =array();
        }
        $role->perms()->sync($perms);

        $msg =array('msg' => '已成功更新');
        return json_encode($msg);
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
			'display_name' => 'max:255'
		]);

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator);
		}

		$role = Role::findOrFail($id);
		$role->update($data);

		$msg =array('msg' => '已成功更新');
		return json_encode($msg);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		Role::destroy($id);
		$code = 200;
		$msg = json_encode(array('msg'=>$code));
		return $msg;
	}

    private function buildTree($actions, $pid = 0)
    {
        $returnValue = array();
        foreach ($actions as $action) {
            if ($action->pid == $pid) {
                $children = $this->buildTree($actions, $action->id);
                if ($children) {
                    $action->children = $children;
                }
                $returnValue[] = $action;
            }
        }
        return collect($returnValue);
    }
}
