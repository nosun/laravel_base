@extends('_layouts.admin')
@section('user_css')
@endsection
@section('content')
<link rel="stylesheet" href="../assets/css/datepicker.css" />
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
                <div class="widget-box " style="margin:0px">
                    <div class="table-header">单页任务列表</div>
                    <table class="table table-striped table-bordered table-hover dataTable" id="mytable" >
                        <thead>
                        <tr>
                            <th width="10%">名称</th>
                            <th width="10%">执行频率</th>
                            <th width="10%">执行状态</th>
                            <th width="10%">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($list as $row )
                            <tr>
                                <td id="name_{{$row->id}}">{{ $row->name }}</td>
                                <td id="cron_{{$row->id}}">{{ $row->cron }}</td>
                                <input id="sta_{{$row->id}}" value="{{$row->status}}" type="hidden">
                                <td id="status_{{$row->id}}"><?php if($row->status == 1){echo '正在执行'; }else{echo '该任务已停止';} ?></td>
                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">
                                        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" title="编辑"
                                                data-target="#edit-form" data-title="编辑任务" data-value='edit' data-id="{{ $row->id }}">
                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                        </button>
                                        <a class="btn btn-xs btn-warning" href="/admin/cron/{{ $row->name }}" title="查看日志">
                                            <i class="ace-icon fa fa-flag bigger-120"></i>
                                        </a>
                                    </div>

                                    <div class="hidden-md hidden-lg">
                                        <div class="inline pos-rel">
                                            <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a class="tooltip-success" data-toggle="modal"
                                                       data-target="#edit-form" data-title="编辑任务" data-value='edit' data-id="{{ $row->id }}">
                                                    <span class="green">
                                                         <i class="ace-icon fa fa-pencil icon-only bigger-110"></i>
                                                    </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="tooltip-info" href="/admin/cron/{{ $row->name }}" title="查看日志">
                                                        <span class="blue">
                                                            <i class="ace-icon fa fa-search-plus bigger-110"></i>
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
                                <label for="description" class="col-sm-2 control-label">名称</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class="form-control" name="name" id="editDescription">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">执行频率</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class="form-control" name="cron" id="editDescription">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">执行状态</label>
                                <div class="col-xs-12 col-sm-6">
                                    <select id="status" name="status" class="form-control">
                                        <option value="1">正在执行</option>
                                        <option value="0">停止任务</option>
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


@endsection
@section('user_js')
<script src="../assets/js/date-time/bootstrap-datepicker.js"></script>
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
                var url     = '/admin/cron/'+ id;
                var company = $('#sta_'+id).val();
                var methord = 'put';
                $("input[name='name']").attr('disabled','disabled');
                modal.find("input[name='name']").val($('#name_'+id).html());
                modal.find("input[name='cron']").val($('#cron_'+id).html());
                $("#status").find("option[value='"+ company +"']").attr("selected",true);
            }

            if(value == 'create'){
                var url = '/admin/cron';
                var methord = 'post';
            }
            $('#myform').attr("data-url",url);
            $('#myform').attr("data-methord",methord);
        });

        $(document).ready(function() {
            $('#myform').submit(function(event) {
                var methord = $("#myform").attr('data-methord');
                var formData = {
                    'name':$('input[name=name]').val(),
                    'cron':$('input[name=cron]').val(),
                    'status':$('select[name=status]').val()
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
                            setInterval(reload,500);
                        })
                    // using the fail promise callback
                        .fail(function(data) {
                            $('#msg').addClass('alert','alert-success').html('格式不正确');
                            event.preventDefault();
                        });
                event.preventDefault();
            })
        });


        $('input[name=publish_time]').datepicker({
            autoclose: true,
            todayHighlight: true
        }).next().on(ace.click_event, function(){
            $(this).prev().focus();
        });

        function reload(){
            window.location.reload();
        }

        jQuery(function ($) {
            $('#mytable')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                    .dataTable({
                        bAutoWidth: false,
                        "aoColumns": [
                            null, null, null, { "bSortable": false }
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
