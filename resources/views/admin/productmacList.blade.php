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
                <a class="btn btn-xs btn-success insertinput" data-toggle="modal" data-target="#edit-form" style="float: right;margin-top: 3px;" data-title="批量添加sn" data-value='create'>
                    <i class="ace-icon fa fa-plus bigger-120"></i>批量添加sn
                </a>
            </h1>
        </div>
        <div class="widget-body" id="searchformdiv">
            <div class="profile-user-info profile-user-info-striped" style="width: 100%;">
                <form class="form-search" name="searchform" method="get" action="/admin/productmac" >
                    <div class="" style="width:250px;float:left;">
                        <div class="profile-info-name"> 供应商名称 </div>
                        <div class="profile-info-value">
                            <select name="searchcompany">
                                <option value="0">请选择模块</option>
                                @foreach($name['module'] as $k=>$v)
                                    <option value="{{$k}}" <?php echo isset($_GET['searchmodule'])?($k==$_GET['searchmodule']?'selected':''):''; ?>>{{$v}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="" style="width:250px;float:left;">
                        <div class="profile-info-name"> mac </div>
                        <div class="profile-info-value">
                            <input type="text" name="searchmac" placeholder="请输入mac" value="<?php echo isset($_GET['searchmac'])? $_GET['searchmac']:''; ?>"
                                   class="search-query" autocomplete="off">
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
                    <div class="table-header">单页sn列表</div>
                    <table class="table table-striped table-bordered table-hover dataTable" id="mytable" >
                        <thead>
                        <tr>
                            <th width="10%">mac</th>
                            <th width="10%">产品名称</th>
                            <th width="10%">模块名称</th>
                            <th width="10%">order</th>
                            <th width="5%">用途</th>
                            <th width="5%">状态</th>
                            <th width="10%">插入时间</th>
                            <th width="10%">更新时间</th>
                            <th width="10%">备注</th>
                            <th width="10%">操作</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($list as $row )
                            <tr>
                                <td id="mac_{{$row->id}}">{{$row->mac}}</td>
                                <td id="product_{{$row->id}}">@if(isset($u_data['product'][$row->product_id])){{$u_data['product'][$row->product_id]}}@endif</td>
                                <td id="module_{{$row->id}}">@if(isset($row->module_id)){{$name['module'][$row->module_id]}}@endif</td>
                                <td id="order_id_{{$row->id}}">{{$row->order_id}}</td>
                                <td id="usage_{{$row->id}}">@if(isset($row->usage)){{$name['usage'][$row->usage]}}@endif</td>
                                <td id="status_{{$row->id}}">@if(isset($row->status)){{$name['status'][$row->status]}}@endif</td>
                                <td id="addtime_{{$row->id}}">{{date('Y-m-d H:i:s',$row->addtime)}}</td>
                                <td id="updatetime_{{$row->id}}">@if($row->updatetime!=''){{date('Y-m-d H:i:s',$row->updatetime)}}@endif</td>
                                <td id="mark_{{$row->id}}">{{$row->mark}}</td>
                                <input type="hidden" id="product_id_{{$row->id}}" value="{{$row->product_id}}">
                                <input type="hidden" id="module_id_{{$row->id}}" value="{{$row->module_id}}">
                                <input type="hidden" id="usage_id_{{$row->id}}" value="{{$row->usage}}">
                                <input type="hidden" id="status_id_{{$row->id}}" value="{{$row->status}}">
                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">
                                        <button type="button" class="btn btn-xs btn-success seccessinput" data-toggle="modal" title="编辑"
                                                data-target="#edit-form" data-title="编辑产品" data-value='edit' data-id="{{ $row->id }}">
                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-danger dangerinput" data-toggle="modal"
                                                data-target=".bs-example-modal-sm" title="删除" data-id="{{ $row->id }}">
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
                                                       data-target="#edit-form" data-title="编辑app" data-value='edit' data-id="{{ $row->id }}">
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
                </div>
                <?php echo $list->render(); ?>
            </div>
            <!-- /.span -->
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
                </div>
            </div>
        </div>
    </div>


    <div id="edit-form" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger"></h4>
                </div>
                <form method="post" class="form-horizontal" action="/admin/productmac" id ="myfile" name="fromceshi" target="hidden_frame" enctype="multipart/form-data" >
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="form-group upload">
                                <label for="name" class="col-sm-2 control-label">mac上传</label>
                                <div class="col-xs-12" style="width: 300px;">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input id="id-input-file-2" type="file" name="file" value="上传apk" onchange="filechange()" />
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

                <form method="post" class="form-horizontal" action="/admin/productmac" id ="myform" name="fromceshi" target="hidden_frame" enctype="multipart/form-data" >
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="form-group update">
                                <label for="name" class="col-sm-2 control-label">mac</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="mac" class="form-control">
                                </div>
                            </div>
                            <div class="form-group update">
                                <label for="name" class="col-sm-2 control-label">模块名称</label>
                                <div class="col-xs-12 col-sm-6">
                                    <select id="module_id" name="module_id">
                                        <option value="0">请选择模块</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group update">
                                <label for="name" class="col-sm-2 control-label">产品名称</label>
                                <div class="col-xs-12 col-sm-6">
                                    <select id="product_id" name="product_id">
                                        <option value="0">请选择产品</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group update">
                                <label for="name" class="col-sm-2 control-label">order</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="order_id" class="form-control">
                                </div>
                            </div>
                            <div class="form-group update">
                                <label for="name" class="col-sm-2 control-label">用途</label>
                                <div class="col-xs-12 col-sm-6">
                                    <select id="usage" name="usage">
                                        <option value="0">请选择用途</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group update">
                                <label for="name" class="col-sm-2 control-label">状态</label>
                                <div class="col-xs-12 col-sm-6">
                                    <select id="status" name="status">
                                        <option value="0">请选择状态</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group update">
                                <label for="name" class="col-sm-2 control-label">备注</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="mark" class="form-control">
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
                    <div id="msg1"></div>
                </form>
                <iframe name='hidden_frame' id="hidden_frame"style='display:none'></iframe>

            </div>
        </div>
    </div>
@endsection
@section('user_js')
    @if(!isset($list[0]) && isset($_GET['searchmac']))
        <script>
            $(function(){
                alert('未搜索到结果');
                window.location.href="/admin/productmac";
            });
        </script>
    @endif
<script src="/assets/js/ace/elements.fileinput.js"></script>
<script src="/assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function filechange(){
            var file = $('#id-input-file-2').val();
            var arr = file.split(".");
            if(arr[arr.length-1] != 'csv'){
                alert('请选择csv格式的文件');
                var file = $("#id-input-file-2");
                file.after(file.clone().val(""));
                file.remove();
                $('.ace-file-container').remove();
                $('#id-input-file-2').ace_file_input({
                    no_file:'No File ...',
                    btn_choose:'Choose',
                    btn_change:'Change'
                });
            }
        }

        $('#edit-form').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var value  = button.data('value'); //button value
            var title  = button.data('title');
            var modal = $(this);
            modal.find('h4').html(title);

            $("#module_id").find("option").remove();
            $("#module_id").append("<option value='0'>请选择类型</option>");
            $("#product_id").find("option").remove();
            $("#product_id").append("<option value='0'>请选择类型</option>");
            $("#usage").find("option").remove();
            $("#usage").append("<option value='0'>请选择类型</option>");
            $("#status").find("option").remove();
            $("#status").append("<option value='0'>请选择类型</option>");

            <?php
            foreach($name['module'] as $k=>$v){
                echo '$("#module_id").append("<option value='.$k.'>'.$v.'</option>");';
            }
            foreach($u_data['product'] as $k=>$v){
                echo '$("#product_id").append("<option value='.$k.'>'.$v.'</option>");';
            }
            foreach($name['usage'] as $k=>$v){
                echo '$("#usage").append("<option value='.$k.'>'.$v.'</option>");';
            }
            foreach($name['status'] as $k=>$v){
                echo '$("#status").append("<option value='.$k.'>'.$v.'</option>");';
            }
            ?>

            if (value == 'edit'){
                var id      = button.data('id');
                var url     = '/admin/productmac/'+ id;
                var methord = 'put';
                var module = $('#module_id_'+id).val();
                var product    = $('#product_id_'+id).val();
                var usage = $('#usage_id_'+id).val();
                var status    = $('#status_id_'+id).val();

                $('#myfile').hide();
                $("#myform").show();
                modal.find("input[name='order_id']").val($('#order_id_'+id).html());
                modal.find("input[name='mark']").val($('#mark_'+id).html());
                modal.find("input[name='mac']").val($('#mac_'+id).html());

                $("#module_id").find("option[value='"+ module +"']").attr("selected",true);
                $("#product_id").find("option[value='"+ product +"']").attr("selected",true);
                $("#usage").find("option[value='"+ usage +"']").attr("selected",true);
                $("#status").find("option[value='"+ status +"']").attr("selected",true);
            }

            if(value == 'create'){

                $('#myform').hide();
                $("#myfile").show();

            }
            $('#myform').attr("data-url",url);
            $('#myform').attr("data-methord",methord);
        });

        $(document).ready(function() {
            $('#myform').submit(function(event) {
                var methord = $("#myform").attr('data-methord');
                var formData = {
                    'mac':$('input[name=mac]').val(),
                    'product_id':$('select[name=product_id]').val(),
                    'usage':$('select[name=usage]').val(),
                    'status':$('select[name=status]').val(),
                    'module_id':$('select[name=module_id]').val(),
                    'order_id':$('input[name=order_id]').val(),
                    'mark':$('input[name=mark]').val()
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
                            $('#msg1').addClass('alert','alert-success').html(data.msg);
                            setTimeout(reload,500);
                        })
                    // using the fail promise callback
                        .fail(function(data) {
                            $('#msg1').addClass('alert','alert-success').html('格式不正确');
                            setTimeout(clear,1000);
                            event.preventDefault();
                        });
                event.preventDefault();
            })
        });

        $('#delConfirmModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('id'); // Extract app_info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            modal.find('#modal-cont').val(recipient);
        });

        $("#deleteIt").on('click',function(event){
            var id= $('#modal-cont').val();
            $.ajax({
                type : "DELETE",
                url : "/admin/productmac/" + id,
                dataType:"json",
                success:function(data){
                    alert(data.msg);
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

        function callback(message,data,success){
            if(success==false){
                if(data == ''){
                    $('#msg').addClass('alert','alert-success').html(message);
                    setTimeout(clear,1000);
                }else{
                    $('#msg').addClass('alert','alert-success').html(message+',插入'+data['num']+'条');
                    setTimeout(reload,1000);
                }

            }
        }

        $(' #id-input-file-2').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change'
        });

        function clear(){
            $("#msg1").removeClass().empty();
            $("#msg").removeClass().empty();
        }

        function reload(){
            window.location.href="productmac";
        }

        jQuery(function ($) {
            $('#mytable')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                    .dataTable({
                        bAutoWidth: false,
                        "aoColumns": [
                            null, null, null, null, null, null, null, null, null,{ "bSortable": false }
                        ],
                        "oLanguage": {//下面是一些汉语翻译
                            "sSearch": "当前页搜索",
                            "sLengthMenu": "每页显示 _MENU_ 条记录",
                            "sInfo": "显示 _START_ 至 _END_ 条 &nbsp;&nbsp;共 _TOTAL_ 条",
                            "sZeroRecords": "没有检索到数据",
                            "sInfoEmpty":"显示 0 至 0 条 &nbsp;&nbsp;共 0 条",
                            "sInfoFiltered": "(筛选自 _MAX_ 条数据)"
                        },
                        "iDisplayLength": 50,
                        "bPaginate": false,
                        "bFilter": false
                    });
        });
    </script>

@endsection
