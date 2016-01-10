@extends('_layouts.admin')
@section('user_css')

@endsection
@section('content')
<div class="page-content">
<div class="user_banner"></div>
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <div>
            <div id="user-profile-1" class="user-profile row">
                <div class="col-xs-12 col-sm-3 center">
                    <div>
                        <!-- #section:pages/profile.picture -->
                        <span class="profile-picture">
                            <img id="avatar" class="editable img-responsive" alt="Alex's Avatar"
                                 src="../assets/avatars/profile-pic.jpg"/>
                        </span>
                    </div>
                    <div class="space-6"></div>
                </div>

                <div class="col-xs-12 col-sm-9">
            <div class="left">
                        <a href="/admin/product">
                        <span class="btn btn-app btn-sm btn-grey no-hover">
                            <span class="line-height-1 bigger-170"> {{$data['product_num']}} </span>
                            <br/>
                            <span class="line-height-1 smaller-90"> 产品数量 </span>
                        </span>
                        </a>
                        <a href="/admin/device">
                        <span class="btn btn-app btn-sm btn-success no-hover">
                            <span class="line-height-1 bigger-170"> {{$data['device_num']}} </span>
                            <br/>
                            <span class="line-height-1 smaller-90"> 设备数量 </span>
                        </span>
                        </a>
                        <a href="/admin/user">
                        <span class="btn btn-app btn-sm btn-primary no-hover">
                            <span class="line-height-1 bigger-170"> {{$data['user_num']}} </span>
                            <br/>
                            <span class="line-height-1 smaller-90"> 用户数量 </span>
                        </span>
                        </a>
                    </div>

                    <div class="space-12"></div>

                    <!-- #section:pages/profile.info -->
                    <div class="profile-user-info profile-user-info-striped">
                        <div class="profile-info-row">
                            <div class="profile-info-name"> 用户名称 </div>
                            <div class="profile-info-value">
                                <span class="editable" id="username">{{$user->name}}</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> 公司名称 </div>
                            <div class="profile-info-value">
                                <span class="editable" id="country">{{$u_data['company'][$user->company_id]}}</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> 电子邮箱 </div>
                            <div class="profile-info-value">
                                <span class="editable" id="age">{{$user->email}}</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> 注册时间 </div>
                            <div class="profile-info-value">
                                <span class="editable" id="signup">{{$user->created_at}}</span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> 最后登录 </div>
                            <div class="profile-info-value">
                                <span class="editable" id="login">{{date('Y-m-d H:i:s',$data['login_time'])}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- PAGE CONTENT ENDS -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<div id="edit-form" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger"></h4>
            </div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong> 很抱歉~ </strong>您的输入有误，请重新输入 <br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="form-horizontal" role="form" accept-charset="utf-8" id="myform">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">用户名</label>

                            <div class="col-xs-12 col-sm-6">
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" placeholder="用户名" name="name" class="form-control" required>
                                        <i class="ace-icon fa fa-user"></i>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>

                            <div class="col-xs-12 col-sm-6">
                                    <span class="block input-icon input-icon-right">
                                        <input type="text" placeholder="电子邮件" name="email" class="form-control"
                                               required>
                                        <i class="ace-icon fa fa fa-envelope"></i>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">密码</label>

                            <div class="col-xs-12 col-sm-6">
                                    <span class="block input-icon input-icon-right">
                                        <input type="password" placeholder="密码" name="password" class="form-control"
                                               required>
                                        <i class="ace-icon fa fa-lock"></i>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company_id" class="col-sm-2 control-label">公司</label>

                            <div class="col-xs-12 col-sm-6">
                                <select name="company_id" class="form-control" id="editSelectCompany">
                                    <option value="1">合众</option>
                                    <option value="2">荣事达</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-sm-2 control-label">状态</label>

                            <div class="col-xs-12 col-sm-6">
                                <select name="status" class="form-control" id="editSelectStatus">
                                    <option value="1">正常</option>
                                    <option value="2">锁定</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="roles" class="col-sm-2 control-label">角色</label>

                            <div class="col-xs-12 col-sm-6">
                                <select name="roles" class="form-control" id="editSelectRole" size=8 multiple>
                                    <option value="1">超级管理员</option>
                                    <option value="2">管理员</option>
                                    <option value="3">运营人员</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" type="submit" id="editSubmit">
                        <i class="ace-icon fa fa-check"></i>确定
                    </button>
                    <button type="button" data-dismiss="modal" class="btn btn-sm btn-danger">
                        <i class="ace-icon fa fa-close"></i>关闭
                    </button>
                </div>
                <div id="pass_msg"></div>

            </form>
        </div>
    </div>
</div>
</div>

@endsection
@section('user_js')
@endsection
