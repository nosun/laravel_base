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
            <a data-toggle="modal" href="#edit-form" class="btn btn-xs btn-success"
               data-title="添加用户" data-value="create" style="float: right">
                <i class="ace-icon fa fa-plus bigger-120"></i> 添加用户
            </a>
        </h1>

    </div>
    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="col-xs-12">
            <table id="gird" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th width="20%">用户名</th>
                    <th width="20%">公司</th>
                    <th width="30%">角色</th>
                    <th width="10%">状态</th>
                    <th width="20%">操作</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($list as $user )
                    <tr>
                        <td id="name_{{ $user->id }}">{{ $user->name }}</td>
                        <td id="email_{{ $user->id }}" style="display: none">{{ $user->email }}</td>
                        <td id="company_{{ $user->id }}" mydata ="{{$user->company_id}}" >{{ $u_data['company'][$user->company_id] }}</td>
                        <?php
                            $role_name ='';
                            $role_id ='[';
                            foreach($user->roles as $role){
                                $role_name .= $role->name.' ';
                                $role_id .= $role->id.',';
                            }
                                $role_name = trim($role_name,' ');
                                $role_id = rtrim($role_id,',').']';
                        ?>
                        <td id="role_{{ $user->id }}" mydata ="<?php echo $role_id;?>" >
                                <?php echo $role_name ?>
                        </td>

                        <td id="status_{{ $user->id }}" mydata ="{{$user->status}}">
                            @if ($user->status == 2)
                                <span class="label label-sm label-warning">锁定</span>
                            @else
                                <span class="label label-sm label-sucess">正常</span>
                            @endif
                        </td>
                        <td>
                            <div class="hidden-sm hidden-xs btn-group">
                                <button type="button" class="btn btn-xs btn-success" data-toggle="modal" title="编辑"
                                        data-target="#edit-form" data-title="编辑用户" data-value='edit' data-id="{{ $user->id }}">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                        data-target=".bs-example-modal-sm" title="删除" data-id="{{ $user->id }}">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </button>
                            </div>

                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        <li>
                                            <a class="tooltip-success" data-toggle="modal"
                                                    data-target="#edit-form" data-title="编辑用户" data-value='edit' data-id="{{ $user->id }}">
                                                <span class="green">
                                                     <i class="ace-icon fa fa-pencil icon-only bigger-110"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="tooltip-danger" data-toggle="modal"
                                                    data-target=".bs-example-modal-sm" title="delete" data-id="{{ $user->id }}">
                                                <span class="red">
                                                    <i class="ace-icon fa fa-trash-o icon-only bigger-110"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <?php echo $list->render(); ?>
        </div>
        <!-- /.span -->
    </div>
    <!-- /.row -->
    <!-- Small modal -->
    <div id="delConfirmModal" class="modal fade bs-example-modal-sm" role="dialog" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">消息</h4>
                </div>
                <div class="modal-body" id="delMsg">
                    确定要删除么?
                </div>
                <input type="hidden" id="modal-cont" value=''>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id = "deleteCancel">关闭</button>
                    <button type="button" class="btn btn-primary" id="deleteIt">确定</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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
                <form class="form-horizontal" role="form" accept-charset="utf-8" id ="myform">
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
                                        <input type="text" placeholder="电子邮件" name="email" class="form-control" required>
                                        <i class="ace-icon fa fa fa-envelope"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">密码</label>
                                <div class="col-xs-12 col-sm-6">
                                    <span class="block input-icon input-icon-right">
                                        <input type="password" placeholder="密码" name="password" class="form-control" required>
                                        <i class="ace-icon fa fa-lock"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="company_id" class="col-sm-2 control-label">公司</label>
                                <div class="col-xs-12 col-sm-6">
                                    <select name="company_id"  class="form-control" id ="editSelectCompany">
                                        @foreach ($u_data['company'] as $key=>$value)
                                            <option value={{$key}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">状态</label>
                                <div class="col-xs-12 col-sm-6">
                                    <select name="status"  class="form-control" id ="editSelectStatus">
                                        <option value="1">正常</option>
                                        <option value="2">锁定</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="roles" class="col-sm-2 control-label">角色</label>
                                <div class="col-xs-12 col-sm-6">
                                    <select name="roles"  class="form-control" id ="editSelectRole" size=8 multiple>
                                        @foreach ($u_data['role'] as $key=>$value)
                                            <option value={{$key}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-sm btn-primary"  type="submit" id="editSubmit">
                            <i class="ace-icon fa fa-check"></i>确定
                        </button>
                        <button type="button" data-dismiss="modal" class="btn btn-sm btn-danger">
                            <i class="ace-icon fa fa-close"></i>关闭
                        </button>
                    </div>
                    <div id="msg"></div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('user_js')
    <script type="javascript" src="/assets/js/jquery.form.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#edit-form').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var value  = button.data('value'); //button value
            var title  = button.data('title');
            var modal = $(this);
            modal.find('h4').html(title);

            if (value == 'edit'){
                var id      = button.data('id');
                var url     = '/admin/admin/'+ id;
                var methord = 'PUT';
                var status  = $('#status_'+id).attr('mydata');
                var company = $('#company_'+id).attr('mydata');
                var role    = $('#role_'+id).attr('mydata');
                role = JSON.parse(role);
                modal.find("input[name='name']").val($('#name_'+id).html());
                modal.find("input[name='email']").val($('#email_'+id).html());
                modal.find("input[name='password']").val('').attr('required',false);
                //此处调试很久 ，主要在于value 后需要跟单引号，坑。
                $("#editSelectStatus").find("option[value='" + status +"']").attr("selected",true);
                $("#editSelectCompany").find("option[value='"+ company +"']").attr("selected",true);
                //此处调试很久，原来这个地方需要json对象，字符串虽然长得像，但还是有差别的。
                $("#editSelectRole").val(role);
            }

            if(value == 'create'){
                var url = '/admin/admin';
                var methord = 'POST';
                modal.find("input[name='name']").val('Name');
                modal.find("input[name='email']").val('Email');
                modal.find("input[name='password']").val('');
                $("#editSelectStatus").find("option[value='1']").attr("selected",true);
                $("#editSelectCompany").find("option[value='1']").attr("selected",true);
                $("#editSelectRole").find("option[value='0']").attr("selected",true);
            }
            $('#myform').attr("data-url",url);
            $('#myform').attr("data-methord",methord);
        });

        $('#delConfirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('id'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('#modal-cont').val(recipient);
        });

        $(document).ready(function() {
            $('#myform').submit(function(event) {
                var methord = $("#myform").attr('data-methord');
                if( methord == 'POST' && $("input[name='password']").val().length <6){
                    $('#msg').addClass('alert','alert-fail').html("密码长度不能小于6位");
                    event.preventDefault();
                 }else{
                    var formData = {
                        'name':$('input[name=name]').val(),
                        'email':$('input[name=email]').val(),
                        'password':$('input[name=password]').val(),
                        'company_id': $('select[name=company_id]').val(),
                        'status': $('select[name=status]').val(),
                        'roles': $('select[name=roles]').val(),
                        '_token': $('input[name=_token]').val()
                    };
                    // process the form
                    $.ajax({
                        type : methord,
                        url  : $("#myform").attr('data-url'),
                        data : formData, // our data object
                        dataType : 'json', // what type of data do we expect back from the server
                        encode : true
                    })
                        // using the done promise callback
                            .done(function(data) {
                                $('#msg').addClass('alert','alert-success').html(data.msg);
                                setTimeout(reload,500);
                            })
                        // using the fail promise callback
                            .fail(function(data) {
                                $('#msg').addClass('alert','alert-success').html(data.responseJSON.name[0]);
                                event.preventDefault();
                            });
                    event.preventDefault();
                }
                // stop the form from submitting the normal way and refreshing the page
                event.preventDefault();
            })
        });

        $("#deleteIt").on('click',function(event){
            var id= $('#modal-cont').val();
            sid = <?php echo Auth::user()->id ?>;
            if (id == sid){
                $('#delMsg').html('您不能删除自己的账号！')
                event.preventDefault();
                return false;
            }
            $.ajax({
                type : "DELETE",
                url : "/admin/admin/" + id,
                dataType:"json",
                success:function(data){
                    if (data.msg == 200){
                        $('#delMsg').html('您已经成功删除该信息')
                    }
                    setTimeout(reload,500);
                    //$("#deleteIt").attr('disabled',true);
                    //$("#deleteIt").attr('data-dismiss',"modal");
                }
            })

        });
        $('#delConfirmModal').on('hide.bs.modal', function () {
            window.location.reload();
        });

        $.setOption = function (url,selector,sub_selector,option,key1,key2) {
            if($(selector).val()!="0"){
                $.getJSON(url , function(json){
                    $.each(json.result,function(skey,svalue){
                        option = option + "<option value='"+svalue[key1]+"'>"+svalue[key2] + "</option>";
                    });
                    $(sub_selector).empty().append(option);
                });
            }else{
                $(sub_selector).empty().append(option);
            }
        };

        function reload(){
            window.location.reload();
        }
    </script>

@endsection
