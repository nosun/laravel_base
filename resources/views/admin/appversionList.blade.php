@extends('_layouts.admin')
@section('user_css')
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="/assets/css/webuploader.css">
    <div class="page-content">
        <div class="page-header" style="position: relative">
            <h1>
                {{ $title }}
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    &nbsp;
                </small>
                <a class="btn btn-xs btn-success insertinput" data-toggle="modal" data-target="#edit-form" style="float: right;margin-top: 3px;" data-title="添加app版本" data-value='create'>
                    <i class="ace-icon fa fa-plus bigger-120"></i>添加app版本
                </a>
            </h1>
        </div>
        <div class="widget-body" id="searchformdiv">
            <div class="profile-user-info profile-user-info-striped" style="width: 100%;">
                <form class="form-search" name="searchform" method="get" action="/admin/appversion" >
                    <div style="width:250px;float:left;">
                        <div class="profile-info-name"> 名称 </div>
                        <div class="profile-info-value">
                            <input type="text" name="searchname" placeholder="请输入名称" value="<?php echo isset($_GET['searchname'])? $_GET['searchname']:''; ?>"
                                   class="search-query" autocomplete="off">
                        </div>
                    </div>
                    <div style="width:250px;float:left;">
                        <div class="profile-info-name"> 版本号 </div>
                        <div class="profile-info-value">
                            <input type="text" name="searchversion" placeholder="请输入版本号" value="<?php echo isset($_GET['searchversion'])? $_GET['searchversion']:''; ?>"
                                   class="search-query" autocomplete="off">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm" style="margin-top:6px;margin-left:20px;">搜索</button>
                </form>
            </div>
        </div>
        <!-- PAGE CONTENT BEGINS -->
        @foreach($version as $k=>$v)
            <input id="app_code_{{$k}}" type="hidden" value="{{$v}}" >
        @endforeach
        <div class="row">
            <div class="col-xs-12">
                <div class="widget-box " style="margin:0px">
                    <div class="table-header">单页app版本列表</div>
                    <table class="table table-striped table-bordered table-hover dataTable" id="mytable" >
                    <thead>
                    <tr>
                        <th width="10%">名称</th>
                        <th width="10%">版本号</th>
                        <th width="10%">版本序号</th>
                        <th width="10%">版本大小</th>
                        <th width="10%">版本摘要</th>
                        <th width="10%">类型</th>
                        <th width="10%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($list as $row )
                        <tr>
                            <input type="hidden" id="app_id_value_{{$row->version_id}}" value="{{$row->app_id}}">
                            <td id="app_id_{{$row->version_id}}"><?php if(!empty($u_data['app'][$row->app_id])){echo $u_data['app'][$row->app_id];}else{echo '';}?></td>
                            <td><a href = '{{$row->version_apk_url}}' id="version_name_{{$row->version_id}}">{{ $row->version_name }}</a></td>
                            <td id="version_code_{{$row->version_id}}">{{ $row->version_code }}</td>
                            <td id="version_size_{{$row->version_id}}">{{ $row->version_size }}</td>
                            <td id="version_intro_{{$row->version_id}}" title="{{$row->version_details}}" >{{$row->version_intro}}</td>
                            <td id="version_type_value_{{$row->version_id}}" ><?php if(!empty($row->version_type)){echo $type[$row->version_type];}else{echo '';}?></td>
                            <input type="hidden" id="version_type_{{$row->version_id}}" value="{{$row->version_type}}">
                            <input type="hidden" id="version_details_{{$row->version_id}}" value="{{$row->version_details}}">
                            <input type="hidden" id="version_explain_{{$row->version_id}}" value="{{$row->version_explain}}">
                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    <button type="button" class="btn btn-xs btn-success seccessinput" data-toggle="modal" title="编辑"
                                            data-target="#edit-form" data-title="编辑app版本信息" data-value='edit' data-id="{{ $row->version_id }}">
                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-danger dangerinput" data-toggle="modal"
                                            data-target=".bs-example-modal-sm" title="删除" data-id="{{ $row->version_id }}">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                    </button>
                                </div>

                                <div class="hidden-md hidden-lg">
                                    <div class="inline pos-rel">
                                        <button class="btn btn-minier btn-primary dropdown-toggle buttoninput" data-toggle="dropdown" data-position="auto">
                                            <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                            <li>
                                                <a class="tooltip-success seccessinput" data-toggle="modal"
                                                   data-target="#edit-form" data-title="编辑app版本信息" data-value='edit' data-id="{{ $row->version_id }}">
                                                <span class="green">
                                                     <i class="ace-icon fa fa-pencil icon-only bigger-110"></i>
                                                </span>
                                                </a>
                                            </li>

                                            <li>
                                                <a class="tooltip-danger dangerinput" data-toggle="modal"
                                                   data-target=".bs-example-modal-sm" title="delete" data-id="{{ $row->version_id }}">
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
                <div class="widget-body">
                    <div class="widget-main">
                        <div id="uploader" class="form-group wu-example">
                            <label for="name" class="col-sm-2 control-label">apk上传</label>
                            <div class="btns col-xs-12" style="width: 300px;float: left;">
                                <input id="id-input-file-1" type="file" name="file">
                                <input type="hidden" id="fileid">
                            </div>
                            <button id="ctlBtn" class="btn btn-sm btn-primary" >开始上传</button>
                        </div>
                        <div id="thelist" class="uploader-list"></div>
                    </div>
                </div>

                <form class="form-horizontal" role="form" accept-charset="utf-8" id ="myform">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">app_id</label>
                                <div class="col-xs-12 col-sm-6" >
                                    <input id="creatvalue" type="hidden">
                                    <input id="app_id_path" type="hidden" name="app_id_path" value="" />
                                    <select id="app_id" name="app_id" class="form-control" autocomplete="off">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">版本号</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="version_name" class="form-control" onclick="error();" required>
                                </div>
                            </div>
                            <div class="form-group" id = "version_apk_url_div">
                                <label for="name" class="col-sm-2 control-label">url</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="version_apk_url" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group" id = "version_apk_url_div">
                                <label for="name" class="col-sm-2 control-label">apk大小(k)</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="version_size" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="display_name" class="col-sm-2 control-label">版本序号</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="version_code" id="version_code" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">类型</label>
                                <div class="col-xs-12 col-sm-6">
                                    <select id="version_type" name="version_type" class="form-control" autocomplete="off">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">版本摘要</label>
                                <div class="col-xs-12 col-sm-6">
                                    <textarea class="form-control" rows="2" name="version_intro" id="version_intro" cols="50"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">详细介绍</label>
                                <div class="col-xs-12 col-sm-6">
                                    <textarea class="form-control" rows="4" name="version_details" id="version_details"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">商店说明</label>
                                <div class="col-xs-12 col-sm-6">
                                    <textarea class="form-control" rows="4" name="version_explain" id="version_explain"></textarea>
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
                window.location.href="/admin/appversion";
            });
        </script>
    @endif
<script src="/assets/js/ace/elements.fileinput.js"></script>
<script src="/assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
<script type="text/javascript" src="/assets/js/webuploader.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#app_id").change(function(){
            if($("#creatvalue").val() == 'create') {
                app_id = $(this).val();
                if ($('#app_code_' + app_id).val() != undefined) {
                    $("#version_code").val($('#app_code_' + app_id).val());
                } else {
                    $("#version_code").val('1');
                }
            }
        });

        $('#edit-form').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var value  = button.data('value'); //button value
            var title  = button.data('title');
            var modal = $(this);
            modal.find('h4').html(title);

            $("#app_id").find("option").remove();
            $("#version_type").find("option").remove();
            $("#app_id").append("<option value='0'>请选择类型</option>");
            $("#version_type").append("<option value='0'>请选择类型</option>");
            <?php
            foreach($u_data['app'] as $k=>$v){
                echo '$("#app_id").append("<option value='.$k.'>'.$v.'</option>");';
            }
            foreach($type as $k=>$v){
                echo '$("#version_type").append("<option value='.$k.'>'.$v.'</option>");';
            }
            ?>

            if (value == 'edit'){
                $(window).unload(function() {
                    $('select option').remove();
                });
                var id      = button.data('id');
                var url     = '/admin/appversion/'+ id;
                var methord = 'put';
                var company = $('#app_id_value_'+id).val();
                var type    = $('#version_type_'+id).val();
                $("#version_apk_url_div").hide();
                $("#filefrom").hide();
                modal.find("input[name='app_id']").val($('#app_id_'+id).html());
                modal.find("input[name='version_name']").val($('#version_name_'+id).html());
                modal.find("input[name='version_apk_url']").val($('#version_name_'+id).attr('href'));
                modal.find("input[name='version_code']").val($('#version_code_'+id).html());
                modal.find("input[name='version_size']").val($('#version_size_'+id).html());
                $("#version_intro").val($('#version_intro_'+id).html());
                $("#version_details").val($('#version_details_'+id).val());
                $("#version_explain").val($('#version_explain_'+id).val());

                $("#app_id").find("option[value='"+ company +"']").attr("selected",true);
                $("#version_type").find("option[value='"+ type +"']").attr("selected",true);
            }

            if(value == 'create'){
                var url = '/admin/appversion';
                var methord = 'post';
                if($("#app_id").val() != '0'){
                    app_id = $("#app_id").val();
                }else{
                    app_id = 1;
                }
                $("#filefrom").show();
                $("#version_apk_url_div").show();
                modal.find("input[name='version_code']").val($('#app_code_'+app_id).val());
            }
            $('#creatvalue').val(value);
            $('#myform').attr("data-url",url);
            $('#myform').attr("data-methord",methord);
        });

        $(document).ready(function() {
            $('#myform').submit(function(event) {
                if($("#successnum").val() != '1' &&  $('#creatvalue').val() == 'create'){
                    alert('请先上传文件');
                    return false;
                }
                var methord = $("#myform").attr('data-methord');
                var formData = {
                    'app_id':$('select[name=app_id]').val(),
                    'version_name':$('input[name=version_name]').val(),
                    'version_apk_url':$('input[name=version_apk_url]').val(),
                    'version_code':$('input[name=version_code]').val(),
                    'version_size':$('input[name=version_size]').val(),
                    'version_type':$('select[name=version_type]').val(),
                    'version_intro':$("#version_intro").val(),
                    'version_details':$("#version_details").val(),
                    'version_explain':$("#version_explain").val()
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
            });
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
                url : "/admin/appversion/" + id,
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

        $(' #id-input-file-1').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change'
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
                            null, null, null,null,null,null,{ "bSortable": false }
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

            var btn = $("#ctlBtn");
            var state = '';
            var token = "<?php echo csrf_token(); ?>" ;
            var uploader = WebUploader.create({

                // swf文件路径
                swf: '/assets/images/Uploader.swf',

                // 文件接收服务端。
                server: '/admin/appversion/upfile',

                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '#picker',
                formData:{'_token':token},
                // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                resize: false
            });

            $("input[type=file]").on("change", function (e) {
                uploader.addFiles(e.target.files);
            });

            uploader.on( 'fileQueued', function( file ) {
                //判断文件格式
                var arr = file.name.split('.');
                if(arr[arr.length-1] != 'apk'){
                    alert("请选择apk文件");
                    return false;
                }

                if($("#thelist").html() != 0){
                    var fileid = $("#fileid").val();

                    if($("input[name='version_apk_url']").val() != '' && $("#"+fileid).find('span.state').html() == '已上传'){
                        $.ajax({
                            type : 'post',
                            url  : '/admin/appversion/unlink',
                            data : {'url':$("input[name='version_apk_url']").val()},
                            encode : true
                        })
                    }
                    $("#thelist").html('');
                    uploader.removeFile(fileid);
                }
                $("#fileid").val(file.id);
                $("#thelist").append( '<div id="' + file.id + '" class="item">' +
                '<h5 class="info" style="float: left; margin: 0 50px 0 17%;">' + file.name + '</h5>' +
                '<input type="hidden" id="successnum" >'+
                '<span class="state" >等待上传...</span>' +
                '</div>' );
            });

            uploader.on( 'uploadProgress', function( file, percentage ) {
                var $li = $( '#'+file.id ),
                $percent = $li.find('.progress .progress-bar');

                // 避免重复创建
                if ( !$percent.length ) {
                    $percent = $('<div class="progress progress-striped active" style="width: 80%;margin-left: 10%;">' +
                    '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                    '</div>' +
                    '</div>').appendTo( $li ).find('.progress-bar');
                }

                $li.find('p.state').text('上传中');

                $percent.css( 'width', percentage * 100 + '%' );
            });

            uploader.on( 'uploadSuccess', function( file,response ) {
                $("input[name='version_apk_url']").val(response.url);
                $("input[name='version_size']").val(response.size);
                $("#successnum").val('1');
                $( '#'+file.id ).find('span.state').text('已上传');
            });

            uploader.on( 'uploadError', function( file,response ) {
                $( '#'+file.id ).find('span.state').text('上传出错');
            });

            uploader.on( 'uploadComplete', function( file ) {
                $( '#'+file.id ).find('.progress').fadeOut();
            });

            uploader.on('all', function (type) {
                if (type === 'startUpload') {
                    state = 'uploading';
                } else if (type === 'stopUpload') {
                    state = 'paused';
                } else if (type === 'uploadFinished') {
                    state = 'done';
                }

                if (state === 'uploading') {
                    btn.text('暂停上传');
                } else {
                    btn.text('开始上传');
                }
            });

            btn.on('click', function () {
                if (state === 'uploading') {
                    uploader.stop();
                } else {
                    uploader.upload();
                }
            });
        });


    </script>

@endsection
