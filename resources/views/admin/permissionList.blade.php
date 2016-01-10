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
                   data-title="添加权限" data-value="create" style="float: right">
                    <i class="ace-icon fa fa-plus bigger-120"></i> 添加权限
                </a>
            </h1>

        </div>
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12" id="p_tree">
                <ul>
                    @foreach ($list as $row )
                        <li>
                            <span class="blue">
                                <i class="ace-icon fa fa-plus icon-only bigger-110"></i>
                            </span>
                            <a href="#" >{{$row->display_name}}</a>
                            <a class="tooltip-success pointer" data-toggle="modal"
                               data-target="#edit-form" data-title="编辑用户" data-value='edit' data-id="{{ $row->id }}"
                               data-name = "{{ $row->name }}" data-display_name="{{ $row->display_name }}"
                               data-description = "{{ $row->description }}" data-cat_id ="{{ $row->cat_id }}" >
                                <span class="green">
                                     <i class="ace-icon fa fa-pencil icon-only bigger-110"></i>
                                </span>
                            </a>
                            <a class="tooltip-danger pointer" data-toggle="modal"
                               data-target=".bs-example-modal-sm" title="delete" data-id="{{ $row->id }}">
                                <span class="red">
                                    <i class="ace-icon fa fa-trash-o icon-only bigger-110"></i>
                                </span>
                            </a>
                        </li>
                        @if (count($row->children) != 0)
                            <ul class="child_box">
                            @foreach( $row->children as $child)
                               <li class="child">
                                   <span class="red">
                                     <i class="ace-icon fa fa-minus icon-only bigger-110"></i>
                                   </span>
                                   <a href="#" >{{$child->display_name}}</a>
                                   <a class="tooltip-success pointer" data-toggle="modal"
                                      data-target="#edit-form" data-title="编辑用户" data-value='edit' data-id="{{ $child->id }}"
                                           data-name = "{{ $child->name }}" data-display_name="{{ $child->display_name }}"
                                           data-description = "{{ $child->description }}" data-cat_id ="{{ $child->cat_id }}" >
                                        <span class="green">
                                             <i class="ace-icon fa fa-pencil icon-only bigger-110"></i>
                                        </span>
                                   </a>
                                   <a class="tooltip-danger pointer" data-toggle="modal"
                                      data-target=".bs-example-modal-sm" title="delete" data-id="{{ $child->id }}">
                                        <span class="red">
                                            <i class="ace-icon fa fa-trash-o icon-only bigger-110"></i>
                                        </span>
                                   </a>
                               </li>
                            @endforeach
                            </ul>
                        @endif
                    @endforeach
                </ul>
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
                                    <label for="name" class="col-sm-2 control-label">权限名称</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pid" class="col-sm-2 control-label">父权限</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <select name="cat_id"  class="form-control" id ="editSelectPid">
                                                <option value= 0 >根权限 </option>
                                            @foreach ($list as $row)
                                                <option value={{$row['id']}}>|- {{$row['display_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="display_name" class="col-sm-2 control-label">显示名称</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" name="display_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-2 control-label">详细描述</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <textarea class="form-control" rows="4" name="description" id="editDescription"></textarea>
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
                id      = button.data('id');
                url     = '/admin/permission/'+ id;
                methord = 'PUT';
                modal.find("input[name='name']").val(button.data('name'));
                modal.find("input[name='display_name']").val(button.data('display_name'));
                $("#editDescription").val(button.data('description'));
                $("#editSelectPid").find("option[value ='"+ button.data('cat_id') +"']").attr("selected",true);
            }

            if(value == 'create'){
                url = '/admin/permission';
                methord = 'POST';
                modal.find("input[name='name']").val('');
                modal.find("input[name='display_name']").val('');
                $("#editDescription").val('');
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
                    var formData = {
                        'name':$('input[name=name]').val(),
                        'cat_id':$('select[name=cat_id]').val(),
                        'display_name':$('input[name=display_name]').val(),
                        'description':$("#editDescription").val()
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
            })
        });

        $("#deleteIt").on('click',function(event){
            var id= $('#modal-cont').val();
            $.ajax({
                type : "DELETE",
                url : "/admin/permission/" + id,
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

        function reload(){
            window.location.reload();
        }
    </script>

@endsection
