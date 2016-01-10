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
                <a class="btn btn-xs btn-success insertinput" data-toggle="modal" data-target="#edit-form" style="float: right" data-title="添加服务器" data-value='create'>
                    <i class="ace-icon fa fa-plus bigger-120"></i>添加服务器
                </a>
            </h1>
        </div>

        <!-- PAGE CONTENT BEGINS -->
        <div class="row">
            <div class="col-xs-12">
                <div class="widget-box " style="margin:0px">
                    <div class="table-header">单页服务器列表</div>
                    <table class="table table-striped table-bordered table-hover dataTable" id="mytable" >
                    <thead>
                    <tr>
                        <th width="10%">server_id</th>
                        <th width="10%">server_name</th>
                        <th width="10%">server_ip</th>
                        <th width="10%">server_port</th>
                        <th width="10%">server_type</th>
                        <th width="10%">server_info</th>
                        <th width="10%">server_config</th>
                        <th width="10%">操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($list as $row )
                        <tr>
                            <td id="server_id_{{$row->server_id}}">{{ $row->server_id }}</td>
                            <td id="server_name_{{$row->server_id}}">{{ $row->server_name }}</td>
                            <td id="server_ip_{{$row->server_id}}">{{ $row->server_ip }}</td>
                            <td id="server_port_{{$row->server_id}}">{{ $row->server_port }}</td>
                            <td id="server_type_{{$row->server_id}}">{{ $row->server_type }}</td>
                            <td id="server_info_{{$row->server_id}}">{{ $row->server_info }}</td>
                            <td id="server_config_{{$row->server_id}}">{{ $row->server_config }}</td>
                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    <button type="button" class="btn btn-xs btn-success seccessinput" data-toggle="modal" title="编辑"
                                            data-target="#edit-form" data-title="编辑" data-value='edit' data-id="{{ $row->server_id }}">
                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-danger dangerinput" data-toggle="modal"
                                            data-target=".bs-example-modal-sm" title="删除" data-id="{{ $row->server_id }}">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                    </button>
                                </div>

                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-primary dropdown-toggle buttoninput" data-toggle="dropdown" data-position="auto" style="display: none;">
                                            <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                            <li>
                                                <a class="tooltip-success seccessinput" data-toggle="modal"
                                                   data-target="#edit-form" data-title="编辑" data-value='edit' data-id="{{ $row->server_id }}">
                                                <span class="green">
                                                     <i class="ace-icon fa fa-pencil icon-only bigger-110"></i>
                                                </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a class="tooltip-danger dangerinput" data-toggle="modal"
                                                   data-target=".bs-example-modal-sm" title="删除" data-id="{{ $row->server_id }}">
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
                </div>
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
    </div>


    <div id="edit-form" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger"></h4>
                </div>

                <form class="form-horizontal" role="form" accept-charset="utf-8" id ="myform">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">server_name</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class="form-control" name="server_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">server_ip</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class="form-control" name="server_ip">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">server_port</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class="form-control" name="server_port" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">server_type</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class="form-control" name="server_type" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">server_info</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class="form-control" name="server_info" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">server_config</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class="form-control" name="server_config">
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


@endsection
@section('user_js')
<script src="/assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
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
                var url     = '/admin/server/'+ id;
                var methord = 'put';
                modal.find("input[name='server_name']").val($('#server_name_'+id).html());
                modal.find("input[name='server_ip']").val($('#server_ip_'+id).html());
                modal.find("input[name='server_port']").val($('#server_port_'+id).html());
                modal.find("input[name='server_type']").val($('#server_type_'+id).html());
                modal.find("input[name='server_info']").val($('#server_info_'+id).html());
                modal.find("input[name='server_config']").val($('#server_config_'+id).html());
            }

            if(value == 'create'){
                var url = '/admin/server';
                var methord = 'post';
            }
            $('#myform').attr("data-url",url);
            $('#myform').attr("data-methord",methord);
        });

        $(document).ready(function() {
            $('#myform').submit(function(event) {
                var methord = $("#myform").attr('data-methord');
                var formData = {
                    'server_name':$('input[name=server_name]').val(),
                    'server_ip':$('input[name=server_ip]').val(),
                    'server_port':$('input[name=server_port]').val(),
                    'server_type':$('input[name=server_type]').val(),
                    'server_info':$('input[name=server_info]').val(),
                    'server_config':$('input[name=server_config]').val()
                };

                $.ajax({
                    type : methord,
                    url  : $("#myform").attr('data-url'),
                    data : formData,
                    dataType : 'json',
                    encode : true
                }).done(function(data) {
                    $('#msg').addClass('alert','alert-success').html(data.msg);
                    setTimeout(reload,500);
                }).fail(function(data) {
                    $('#msg').addClass('alert','alert-success').html('格式不正确');
                    event.preventDefault();
                });
                event.preventDefault();
            })
        });

        $('#delConfirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var recipient = button.data('id');
            var modal = $(this);
            modal.find('#modal-cont').val(recipient);
        });

        $("#deleteIt").on('click',function(event){
            var id= $('#modal-cont').val();
            $.ajax({
                type : "DELETE",
                url : "/admin/server/" + id,
                dataType:"json",
                success:function(data){
                    if (data.msg == 200){
                        $('#delMsg').html('您已经成功删除该信息')
                    }
                    setTimeout(reload,500);
                }
            })

        });

        $('#delConfirmModal').on('hide.bs.modal', function () {
            reload();
        });

        function reload(){
            window.location.reload();
        }

        jQuery(function ($) {
            $('#mytable')
                    .dataTable({
                        bAutoWidth: false,
                        "aoColumns": [
                            null, null, null, null, null, null,null,{ "bSortable": false }
                        ],
                        "oLanguage": {//下面是一些汉语翻译
                            "sSearch": "当前页搜索",
                            "sLengthMenu": "每页显示 _MENU_ 条记录",
                            "sInfo": "显示 _START_ 至 _END_ 条 &nbsp;&nbsp;共 _TOTAL_ 条",
                            "sInfoEmpty":"显示 0 至 0 条 &nbsp;&nbsp;共 0 条",
                            "sZeroRecords": "没有检索到数据",
                            "sInfoFiltered": "(筛选自 _MAX_ 条数据)"
                        },
                        "iDisplayLength": 50,
                        "bPaginate": false,
                        "bFilter": false
                    });
        });
    </script>


@endsection
