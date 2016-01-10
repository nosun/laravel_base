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
                    <i class="ace-icon fa fa-plus bigger-120"></i> 添加角色
                </a>
            </h1>

        </div>
        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <table id="gird" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="20%">角色名称</th>
                        <th width="20%">显示名称</th>
                        <th width="30%">详细描述</th>
                        <th width="30%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($list as $row )
                        <tr>
                            <td id="name_{{ $row->id }}">{{ $row->name }}</td>
                            <td id="display_name_{{ $row->id }}">{{ $row->display_name }}</td>
                            <td id="description_{{ $row->id }}">{{ $row->description }}</td>
                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    <a href="/admin/role/permission/{{ $row->id }}" class="btn btn-xs btn-primary"
                                       title="设置权限">
                                        <i class="ace-icon fa fa-lock bigger-120"></i>
                                    </a>
                                    <button type="button" class="btn btn-xs btn-success" data-toggle="modal" title="编辑"
                                            data-target="#edit-form" data-title="编辑角色" data-value='edit' data-id="{{ $row->id }}">
                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-danger" data-toggle="modal"
                                            data-target=".bs-example-modal-sm" title="删除角色" data-id="{{ $row->id }}">
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
                                                   data-target="#edit-form" data-title="编辑角色" data-value='edit' data-id="{{ $row->id }}">
                                                <span class="green">
                                                     <i class="ace-icon fa fa-pencil icon-only bigger-110"></i>
                                                </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a class="tooltip-danger" data-toggle="modal"
                                                   data-target=".bs-example-modal-sm" title="delete" data-id="{{ $row->id }}">
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
                                    <label for="name" class="col-sm-2 control-label">角色名称</label>
                                    <div class="col-xs-12 col-sm-6">
                                        <input type="text" name="name" class="form-control" required>
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
                var id      = button.data('id');
                var url     = '/admin/role/'+ id;
                var methord = 'PUT';
                modal.find("input[name='name']").val($('#name_'+id).html());
                modal.find("input[name='display_name']").val($('#display_name_'+id).html());
                $("#editDescription").val($('#description_'+id).html());
            }

            if(value == 'create'){
                var url = '/admin/role';
                var methord = 'POST';
                modal.find("input[name='name']").val('');
                modal.find("input[name='display_name']").val('');
                modal.find("input[name='description']").val('');
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
                url : "/admin/role/" + id,
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
