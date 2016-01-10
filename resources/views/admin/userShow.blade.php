@extends('_layouts.admin')
@section('user_css')
@endsection
@section('content')
<div class="page-content">
        <div class="page-header" style="position: relative">
        <h1>
            {{ $title }}
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                &nbsp;
            </small>
        </h1>

    </div>
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="col-xs-12">
            <table id="gird" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th width="10%">app</th>
                    <th width="10%">登录名</th>
                    <th width="10%">登录类型</th>
                    <th width="10%">用户名</th>
                    <th width="10%">user_prefer</th>
                    <th width="10%">用户邮箱</th>
                    <th width="10%">手机号码</th>
                    <th width="10%">注册时间</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$list->app_name}}</td>
                    <td>{{$list->login_id}}</td>
                    <td>{{$list->user_type}}</td>
                    <td>{{$list->user_name}}</td>
                    <td>{{$list->user_prefer}}</td>
                    <td>{{$list->user_email}}</td>
                    <td>{{$list->user_phone}}</td>
                    <td>{{date('Y-m-d',$list->reg_time)}}</td>
                </tr>
                </tbody>
            </table>

            <table id="gird" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th width="10%">设备mac</th>
                    <th width="10%">设备名称</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($user))
                @foreach($user as $v)
                <tr>
                    <td>@if($u_data['admin']->company_id > 1){{$v['device_mac']}}@else<a href="/admin/device/{{$v['device_id']}}">{{$v['device_mac']}}</a>@endif</td>
                    <td>{{$v['device_name']}}</td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td align="center" colspan="2">该用户没有绑定设备</td>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
        <!-- /.span -->
    </div>

</div>

@endsection
@section('user_js')
@endsection
