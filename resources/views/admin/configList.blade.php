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
                    <div class="table-header">单页配置列表</div>
                    <table class="table table-striped table-bordered table-hover dataTable" id="mytable" >
                    <thead>
                    <tr>
                        <th width="10%">图片上传地址</th>
                        <th width="10%">apk上传地址</th>
                        <th width="10%">固件上传地址</th>
                        <th width="10%">页面显示数量</th>
                        <th width="10%">更新时间</th>
                        <th width="10%">操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($list as $row )
                        <tr>
                            <td id="img_{{$row->id}}">{{ $row->img_down }}</td>
                            <td id="apk_{{$row->id}}">{{ $row->apk_down }}</td>
                            <td id="bin_{{$row->id}}">{{ $row->bin_down }}</td>
                            <td id="page_{{$row->id}}">{{$row->pagenow}}</td>
                            <td>{{date('Y-m-d',$row->updatetime)}}</td>
                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    <button type="button" class="btn btn-xs btn-success seccessinput" data-toggle="modal" title="编辑"
                                            data-target="#edit-form" data-title="编辑" data-value='edit' data-id="{{ $row->id }}">
                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
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
                                                   data-target="#edit-form" data-title="编辑" data-value='edit' data-id="{{ $row->id }}">
                                                <span class="green">
                                                     <i class="ace-icon fa fa-pencil icon-only bigger-110"></i>
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
                                <label for="description" class="col-sm-3 control-label">图片下载地址</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class="form-control" name="img" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">apk下载地址</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class="form-control" name="apk" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">固件下载地址</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class="form-control" name="bin" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">页面显示数量</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input class="form-control" name="page" type="text" required>
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
            if (value == 'edit') {
                var id = button.data('id');
                var url = '/admin/config/' + id;
                var methord = 'put';
                modal.find("input[name='img']").val($('#img_' + id).html());
                modal.find("input[name='apk']").val($('#apk_' + id).html());
                modal.find("input[name='bin']").val($('#bin_' + id).html());
                modal.find("input[name='page']").val($('#page_' + id).html());
            }

            $('#myform').attr("data-url",url);
            $('#myform').attr("data-methord",methord);
        });

        $(document).ready(function() {
            $('#myform').submit(function(event) {
                var methord = $("#myform").attr('data-methord');
                var formData = {
                    'img_down':$('input[name=img]').val(),
                    'apk_down':$('input[name=apk]').val(),
                    'bin_down':$('input[name=bin]').val(),
                    'pagenow':$('input[name=page]').val()
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
                            $('#msg').addClass('alert','alert-success').html(data);
                            event.preventDefault();
                        });
                event.preventDefault();
            })
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
                            null, null, null, null,null,{ "bSortable": false }
                        ],
                        "oLanguage": {//下面是一些汉语翻译
                            "sSearch": "当前页搜索",
                            "sLengthMenu": "每页显示 _MENU_ 条记录",
                            "sInfo": "显示 _START_ 至 _END_ 条 &nbsp;&nbsp;共 _TOTAL_ 条",
                            "sInfoEmpty":"显示 0 至 0 条 &nbsp;&nbsp;共 0 条",
                            "sZeroRecords": "没有检索到数据",
                            "sInfoFiltered": "(筛选自 _MAX_ 条数据)"
                        },
                        "aaSorting": [[4, "desc"]],
                        "iDisplayLength": 50,
                        "bPaginate": false,
                        "bFilter": false
                    });
        });
    </script>


@endsection
