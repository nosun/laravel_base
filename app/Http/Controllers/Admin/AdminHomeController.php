<?php namespace Yun\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends AdminBaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index()
	{
        $title = '首页';
        $time =strtotime(date('Y-m-d',time()))-86400;
        $data['title'] = '';
        if($this->company>1){
            $user_num = DB::table('yun_count_user_d')->where('updatetime','=',$time)->where('company_id','=',$this->company)->get();
        }else{
            $user_num = DB::table('yun_count_user_d')->where('updatetime','=',$time)->where('company_id','=',0)->get();
        }
        foreach($user_num as $v){
            $data['new_num'] = $v->num_reg_new;
            $data['all_num'] = $v->num_reg_all;
        }
        //$res = AdminConfig::select('notice')->orderby('updatetime','desc')->limit(1)->get();
        //$data['notice'] = $res[0]->notice;
		return view('admin.index',array('list'=>$data,'title'=>$title));
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
	public function update($id)
	{
		//
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
