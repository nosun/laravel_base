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
            <a class="btn btn-xs btn-success insertinput" data-toggle="modal" data-target="#edit-form" style="float: right;margin-top: 3px;" data-title="添加商户" data-value='create'>
                <i class="ace-icon fa fa-plus bigger-120"></i>添加商户
            </a>
        </h1>
    </div>

    <div class="widget-body" id="searchformdiv">
        <div class="profile-user-info profile-user-info-striped" style="width: 100%;">
            <form class="form-search" name="searchform" method="get" action="/admin/user" >
                <div class="" style="width:260px;float: left;">
                    <div class="profile-info-name"> 商户名称 </div>
                    <div class="profile-info-value">
                        <input type="text" name="searchname" placeholder="请输入商户名称" value="<?php echo isset($_GET['searchname'])? $_GET['searchname']:''; ?>"
                               autocomplete="off" class="search-query">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm" style="margin-top:6px;margin-left:20px;">搜索</button>
            </form>
        </div>
    </div>

    <!-- PAGE CONTENT BEGINS -->
    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box " style="margin:0px">
                <!-- #section:custom/widget-box.options -->
                <div class="table-header">单页用户列表</div>
                <!-- <div class="table-responsive"> -->
                <!-- <div class="dataTables_borderWrap"> -->
                <table class="table table-striped table-bordered table-hover dataTable" id="mytable">
                <thead>
                <tr>
                    <th>商户名称</th>
                    <th>商户类型</th>
                    <th>商户地址</th>
                    <th>创建时间</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($list as $row )
                    <tr>
                        <input id="type_{{$row->id}}" type="hidden" value="{{$row->type}}">
                        <td id="name_{{$row->id}}">{{ $row->name }}</td>
                        <td id="type_val_{{$row->id}}">@if(!empty($type[$row->type])){{$type[$row->type]}}@endif</td>
                        <td id="address_{{$row->id}}">{{ $row->address }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>{{ $row->updated_at }}</td>
                        <td>
                            <div class="hidden-sm hidden-xs btn-group">
                                <button type="button" class="btn btn-xs btn-success seccessinput" data-toggle="modal" title="编辑"
                                        data-target="#edit-form" data-title="编辑" data-value='edit' data-id="{{ $row->id }}">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </button>
                                <button type="button" class="btn btn-xs btn-danger dangerinput" data-toggle="modal"
                                        data-target=".bs-example-modal-sm" title="删除" data-id="{{ $row->id }}">
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
                                            <a class="tooltip-success seccessinput" data-toggle="modal"
                                               data-target="#edit-form" data-title="编辑" data-value='edit' data-id="{{ $row->id }}">
                                                <span class="green">
                                                     <i class="ace-icon fa fa-pencil icon-only bigger-110"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="tooltip-danger dangerinput" data-toggle="modal"
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
</div>
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
                            <label for="description" class="col-sm-2 control-label">商户名称</label>
                            <div class="col-xs-12 col-sm-6">
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">商户类型</label>
                            <div class="col-xs-12 col-sm-6">
                                <select id="type" name="type" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">商户地址</label>
                            <div class="col-xs-12 col-sm-6">
                                <input type="text" class="form-control" name="address">
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
    @if(!isset($list[0]) && isset($_GET['searchname']))
        <script>
            $(function(){
                alert('未搜索到结果');
                window.location.href="/admin/company";
            });
        </script>
    @endif
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

            $("#type").find("option").remove();
            $("#type").append("<option value='0'>请选择类型</option>");
            <?php
            foreach($type as $k=>$v){
                echo '$("#type").append("<option value='.$k.'>'.$v.'</option>");';
            }
            ?>

            if (value == 'edit'){
                var id      = button.data('id');
                var url     = '/admin/company/'+ id;
                var methord = 'put';
                var type = $('#type_'+id).val();
                modal.find("input[name='name']").val($('#name_'+id).html());
//                modal.find("input[name='type']").val($('#type_'+id).val());
                $("#type").find("option[value='"+ type +"']").attr("selected",true);
                modal.find("input[name='address']").val($('#address_'+id).html());
            }

            if(value == 'create'){
                var url = '/admin/company';
                var methord = 'post';
            }
            $('#myform').attr("data-url",url);
            $('#myform').attr("data-methord",methord);
        });

        $(document).ready(function() {
            $('#myform').submit(function(event) {
                var methord = $("#myform").attr('data-methord');
                if($('select[name=type]').val() == 0){
                    $('#msg').addClass('alert','alert-success').html('请选择商户类型');
                    event.preventDefault();
                    return false;
                }
                var formData = {
                    'name':$('input[name=name]').val(),
                    'type':$('select[name=type]').val(),
                    'address':$('input[name=address]').val()
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
                            $('#msg').addClass('alert','alert-success').html('格式不正确');
                            event.preventDefault();
                        });
                event.preventDefault();
            })
        });

        $('#delConfirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('id'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('#modal-cont').val(recipient);
        });

        $("#deleteIt").on('click',function(event){
            var id= $('#modal-cont').val();
            $.ajax({
                type : "DELETE",
                url : "/admin/company/" + id,
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
            window.location.reload();
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
                        null, null, null,null,null,{ "bSortable": false }
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

        })
    </script>
@endsection
