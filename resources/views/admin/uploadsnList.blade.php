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
        <div class="page-header">
            <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <i class="ace-icon fa fa-check green"></i>
                总条数为{{$num}}条
            </div>
        </div>

        <div class="widget-body" id="searchformdiv">
            <div class="profile-user-info profile-user-info-striped" style="width: 100%;">
                <form class="form-search" name="searchform" method="get" action="/admin/uploadsn" >
                    <div class="" style="width:250px;float:left;">
                        <div class="profile-info-name"> 产品名称 </div>
                        <div class="profile-info-value">
                            <select name="searchproduct">
                                <option value="0">请选择产品</option>
                                @foreach($u_data['product'] as $k=>$v)
                                    <option value="{{$k}}" <?php echo isset($_GET['searchproduct'])?($k==$_GET['searchproduct']?'selected':''):''; ?>>{{$v}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="" style="width:250px;float:left;">
                        <div class="profile-info-name"> sn </div>
                        <div class="profile-info-value">
                            <input type="text" name="searchsn" placeholder="请输入sn" value="<?php echo isset($_GET['searchsn'])? $_GET['searchsn']:''; ?>"
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
                            <th width="10%">产品名称</th>
                            <th width="10%">sn号</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($list as $row )
                            <tr>
                                <td id="app_id_{{$row->id}}">@if(isset($u_data['product'][$row->product_id])){{$u_data['product'][$row->product_id]}}@endif</td>
                                <td id="sn_{{$row->id}}">{{$row->sn}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <?php echo $list->render(); ?>
            </div>
            <!-- /.span -->
        </div>
    </div>


    <div id="edit-form" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="blue bigger"></h4>
                </div>

                <form method="post" class="form-horizontal" action="/admin/uploadsn/upfile" id ="myform" name="fromceshi" target="hidden_frame" enctype="multipart/form-data" >
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">产品名称</label>
                                <div class="col-xs-12 col-sm-6">
                                    <select name="product_id">
                                        <option value="0">请选择产品</option>
                                        @foreach($u_data['product'] as $k=>$v)
                                            <option value="{{$k}}">{{$v}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">sn上传</label>
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
                <iframe name='hidden_frame' id="hidden_frame"style='display:none'></iframe>

            </div>
        </div>
    </div>
@endsection
@section('user_js')
    @if(!isset($list[0]) && isset($_GET['searchsn']))
        <script>
            $(function(){
                alert('未搜索到结果');
                window.location.href="/admin/uploadsn";
            });
        </script>
    @endif
<script src="/assets/js/ace/elements.fileinput.js"></script>
<script src="/assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script type="text/javascript">
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

        $('#id-input-file-2').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change'
        });

        function clear(){
            $("#msg").removeClass().empty();
        }

        function reload(){
            window.location.href="uploadsn";
        }

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

        jQuery(function ($) {
            $('#mytable')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                    .dataTable({
                        bAutoWidth: false,
                        "aoColumns": [
                            null, null
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
