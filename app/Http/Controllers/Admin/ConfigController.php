<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminConfig;
use Validator;

class ConfigController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
        $list = AdminConfig::orderby('updatetime','desc')->limit(1)->paginate($this->config['page_size']);
        $title = '系统设置';
        return view('admin.configList',array('list'=>$list,'title'=>$title));
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
	public function store()
	{
        //
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
        //
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
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
            'img_down'      => 'between:1,100',
            'apk_down'      => 'between:1,100',
            'bin_down'      => 'between:1,100',
            'pagenow'       => 'numeric|between:1,1000'
        ]);

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $data['updatetime'] = time();
        AdminConfig::where('id','=',$id)->update($data);
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
        //
	}

}
