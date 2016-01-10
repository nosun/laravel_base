<?php namespace Yun\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Permission;
use Validator;

class PermissionController extends AdminBaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$list = Permission::all();
        $list = $this->buildTree($list);
        $title = '权限管理';
        return view('admin.permissionList',array('title'=>$title,'list'=>$list));
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
			'name' => 'required|max:255|unique:permissions',
			'display_name' => 'required|max:255'
		]);

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator);
		}

		Permission::create([
			'name' => $data['name'],
			'cat_id'  => $data['cat_id'],
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
			'display_name' => 'max:255'
		]);

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator);
		}

		$permission = Permission::findOrFail($id);
		$permission->update($data);

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

		Permission::destroy($id);
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
