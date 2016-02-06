<?php namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use App\Models\Site;

class SiteController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
        $list = Site::paginate($this->config['page_size']);
        $title = '服务器列表';
        return view('admin.siteList',array('list'=>$list,'title'=>$title));
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
            'server_name'       => 'between:1,50',
            'server_ip'         => 'ip'
        ]);

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
        Site::create([
            'server_name'       => $data['server_name'],
            'server_ip'         => $data['server_ip'],
            'server_port'       => $data['server_port'],
            'server_type'       => $data['server_type'],
            'server_info'       => $data['server_info'],
            'server_config'     => $data['server_config']
        ]);

        $msg =array('msg' => '已成功更新');
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
            'server_name'       => 'between:1,50',
            'server_ip'         => 'ip'
        ]);

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        Site::where('server_id',$id)->update($data);

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
        Site::where('server_id',$id)->delete();
        $code = 200;
        $msg = json_encode(array('msg'=>$code));
        return $msg;
	}

}
