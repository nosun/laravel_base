@extends('_layouts.admin')
@section('user_css')
@endsection
@section('content')
    <link rel="stylesheet" href="/assets/css/webuploader.css" />
    <link rel="stylesheet" href="/assets/css/datepicker.css" />
    <div class="page-content">
        <div class="page-header" style="position: relative">
            <h1>
                {{ $title }}
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    &nbsp;
                </small>
                <a class="btn btn-xs btn-success insertinput" data-toggle="modal" data-target="#edit-form" style="float: right" data-title="添加固件版本" data-value='create'>
                    <i class="ace-icon fa fa-plus bigger-120"></i>添加固件版本
                </a>
            </h1>
        </div>

        <div class="widget-body" id="searchformdiv">
            <div class="profile-user-info profile-user-info-striped" style="width: 100%;">
                <form class="form-search" name="searchform" method="get" action="/admin/modulefirmware" >
                    <div class="" style="width:250px;float:left;">
                        <div class="profile-info-name"> 名称 </div>
                        <div class="profile-info-value">
                            <input type="text" name="searchname" placeholder="请输入名称" value="<?php echo isset($_GET['searchname'])? $_GET['searchname']:''; ?>"
                                   class="search-query" autocomplete="off">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm" style="margin-top:6px;margin-left:20px;">搜索</button>
                </form>
            </div>
        </div>
        @foreach($version as $k=>$v)
            <input id="module_code_{{$k}}" type="hidden" value="{{$v}}" >
            @endforeach
                    <!-- PAGE CONTENT BEGINS -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="widget-box " style="margin:0px">
                        <div class="table-header">单页模块版本列表</div>
                        <table class="table table-striped table-bordered table-hover dataTable" id="mytable" >
                            <thead>
                            <tr>
                                <th width="8%">module</th>
                                <th width="8%">firmware_type</th>
                                <th width="8%">固件版本序号</th>
                                <th width="8%">固件版本号</th>
                                <th width="10%">串口url</th>
                                <th width="8%">协议版本</th>
                                <th width="8%">更新时间</th>
                                <th width="8%">发布时间</th>
                                <th width="10%">固件简介</th>
                                <th width="10%">更新说明</th>
                                <th width="8%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($list as $row )
                                <tr>
                                    <input type="hidden" id="app_id_value_{{$row->firmware_id}}" value="{{$row->module_id}}">
                                    <td id="modle_id_{{$row->firmware_id}}"><?php if(!empty($name)){echo $name[$row->module_id];}?></td>
                                    <td id="firmware_type_{{$row->firmware_id}}">{{ $row->firmware_type }}</td>
                                    <td id="version_code_{{$row->firmware_id}}">{{ $row->version_code }}</td>
                                    <td><a href ='{{$row->firmware_w_url}}' id="firmware_version_{{$row->firmware_id}}">{{ $row->firmware_version }}</a></td>
                                    <td id="firmware_s_url_{{$row->firmware_id}}">{{$row->firmware_s_url}}</td>
                                    <td id="protocol_id_{{$row->firmware_id}}">
                                        @if(isset($u_data['protocol'][$row->protocol_id])) {{$u_data['protocol'][$row->protocol_id]}} @endif
                                    </td>
                                    <td id="firmware_update_time_{{$row->firmware_id}}">{{ $row->firmware_update_time }}</td>
                                    <td id="firmware_publish_time_{{$row->firmware_id}}">{{$row->firmware_publish_time}}</td>
                                    <td id="firmware_intro_{{$row->firmware_id}}">{{ $row->firmware_intro }}</td>
                                    <td id="firmware_update_intro_{{$row->firmware_id}}">{{$row->firmware_update_intro}}</td>
                                    <td>
                                        <div class="hidden-sm hidden-xs btn-group">
                                            <button type="button" class="btn btn-xs btn-success seccessinput" data-toggle="modal" title="编辑"
                                                    data-target="#edit-form" data-title="编辑app版本信息" data-value='edit' data-id="{{ $row->firmware_id }}">
                                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                                            </button>
                                            <button type="button" class="btn btn-xs btn-danger dangerinput" data-toggle="modal"
                                                    data-target=".bs-example-modal-sm" title="删除" data-id="{{ $row->firmware_id }}">
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
                                                           data-target="#edit-form" data-title="编辑app版本信息" data-value='edit' data-id="{{ $row->firmware_id }}">
                                                <span class="green">
                                                     <i class="ace-icon fa fa-pencil icon-only bigger-110"></i>
                                                </span>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="tooltip-danger dangerinput" data-toggle="modal"
                                                           data-target=".bs-example-modal-sm" title="delete" data-id="{{ $row->firmware_id }}">
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
                            <label for="name" class="col-sm-2 control-label">固件上传</label>
                            <div class="btns col-xs-12" style="width: 300px;float: left;">
                                <input id="id-input-file-1" type="file" name="module_file">
                                <input type="hidden" id="fileid-1">
                            </div>
                            <div style="width: 170px;height:50px;float: left;"></div>
                            {{--<button id="ctlBtn-1" class="btn btn-sm btn-primary" >开始上传</button>--}}
                        </div>
                        <div id="thelist-1" class="uploader-list"></div>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        <div id="uploader" class="form-group wu-example">
                            <label for="name" class="col-sm-2 control-label">串口上传</label>
                            <div class="btns col-xs-12" style="width: 300px;float: left;">
                                <input id="id-input-file-2" type="file" name="module_file">
                                <input type="hidden" id="fileid-2">
                            </div>
                            <button id="ctlBtn" class="btn btn-sm btn-primary" >开始上传</button>
                        </div>
                        <div id="thelist-2" class="uploader-list"></div>
                    </div>
                </div>

                <form class="form-horizontal" role="form" accept-charset="utf-8" id ="myform">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">固件名称</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input id="creatvalue" type="hidden">
                                    <select id="module_id" name="module_id" class="form-control" required>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="display_name" class="col-sm-2 control-label">firmware_type</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="firmware_type" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">版本序号</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="version_code" id="version_code" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">版本号</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="firmware_version" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group" id = "version_w_url_div">
                                <label for="name" class="col-sm-2 control-label">固件url</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="firmware_w_url" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group" id = "version_w_url_div">
                                <label for="name" class="col-sm-2 control-label">固件大小</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="firmware_w_size" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group" id = "version_s_url_div">
                                <label for="name" class="col-sm-2 control-label">串口url</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="firmware_s_url" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group" id = "version_s_url_div">
                                <label for="name" class="col-sm-2 control-label">协议版本</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="protocol_id" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="display_name" class="col-sm-2 control-label">更新时间</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="firmware_update_time" class="form-control" data-date-format="yyyy-mm-dd" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="display_name" class="col-sm-2 control-label">发布时间</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="firmware_publish_time" class="form-control" data-date-format="yyyy-mm-dd" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="display_name" class="col-sm-2 control-label">固件简介</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" name="firmware_intro" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">更新说明</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class="form-control" name="firmware_update_intro" id="editDescription">
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
                window.location.href="/admin/modulefirmware";
            });
        </script>
    @endif
    <script src="/assets/js/ace/elements.fileinput.js"></script>
    <script src="/assets/js/date-time/bootstrap-datepicker.js"></script>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="/assets/js/webuploader.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#module_id").change(function(){
            if($("#creatvalue").val() == 'create'){
                module_id = $(this).val();;
                if($('#module_code_'+module_id).val() != undefined){
                    $("#version_code").val($('#module_code_'+module_id).val());
                }else{
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

            $("#module_id").find("option").remove();
            $("#module_id").append("<option value='0'>请选择固件名称</option>");
            <?php
            foreach($name as $k=>$v){
                echo '$("#module_id").append("<option value='.$k.'>'.$v.'</option>");';
            }
            ?>

            if (value == 'edit'){
                var id      = button.data('id');
                var url     = '/admin/modulefirmware/'+ id;
                var methord = 'put';
                var company = $('#app_id_value_'+id).val();
                $("#version_w_url_div").hide();
                $("#version_s_url_div").hide();
                $("#filefrom").hide();
                $('#app_id_'+id).html();
                modal.find("input[name='firmware_type']").val($('#firmware_type_'+id).html());
                modal.find("input[name='firmware_version']").val($('#firmware_version_'+id).html());
                modal.find("input[name='version_code']").val($('#version_code_'+id).html());
                modal.find("input[name='firmware_w_url']").val($('#firmware_version_'+id).attr('href'));
                modal.find("input[name='protocol_id']").val($('#protocol_id_'+id).html());
                modal.find("input[name='firmware_update_time']").val($('#firmware_update_time_'+id).html());
                modal.find("input[name='firmware_publish_time']").val($('#firmware_publish_time_'+id).html());
                modal.find("input[name='firmware_intro']").val($('#firmware_intro_'+id).html());
                modal.find("input[name='firmware_update_intro']").val($('#firmware_update_intro_'+id).html());
                $("#module_id").find("option[value='"+ company +"']").attr("selected",true);
            }

            if(value == 'create'){
                var url = '/admin/modulefirmware';
                var methord = 'post';
                if($("#module_id").val() != '0'){
                    module_id = $("#module_id").val();
                }else{
                    module_id = 1;
                }
                $("#filefrom").show();
                $("#version_apk_url_div").show();
                modal.find("input[name='version_code']").val($('#module_code_'+module_id).val());
            }
            $('#creatvalue').val(value);
            $('#myform').attr("data-url",url);
            $('#myform').attr("data-methord",methord);
        });

        $(document).ready(function() {
            $('#myform').submit(function(event) {
                if($("#successnum-1").val() != '1' &&  $('#creatvalue').val() == 'create'){
                    alert('请先上传文件');
                    event.preventDefault();
                    return false;
                }
                var methord = $("#myform").attr('data-methord');
                var formData = {
                    'module_id':$('select[name=module_id]').val(),
                    'firmware_version':$('input[name=firmware_version]').val(),
                    'firmware_type':$('input[name=firmware_type]').val(),
                    'firmware_w_url':$('input[name=firmware_w_url]').val(),
                    'firmware_s_url':$('input[name=firmware_s_url]').val(),
                    'protocol_id':$('input[name=protocol_id]').val(),
                    'firmware_update_time':$('input[name=firmware_update_time]').val(),
                    'firmware_publish_time':$('input[name=firmware_publish_time]').val(),
                    'firmware_intro':$('input[name=firmware_intro]').val(),
                    'firmware_update_intro':$('input[name=firmware_update_intro]').val()
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
                url : "/admin/modulefirmware/" + id,
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

        $(' #id-input-file-2,#id-input-file-1').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change'
        });

        $('input[name=firmware_update_time],input[name=firmware_publish_time]').datepicker({
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
                            null, null,null, null, null,null,null,null,null,null,{ "bSortable": false }
                        ],
                        "oLanguage": {//下面是一些汉语翻译
                            "sSearch": "当前页搜索",
                            "sLengthMenu": "每页显示 _MENU_ 条记录",
                            "sInfo": "显示 _START_ 至 _END_ 条 &nbsp;&nbsp;共 _TOTAL_ 条",
                            "sInfoEmpty":"显示 0 至 0 条 &nbsp;&nbsp;共 0 条",
                            "sZeroRecords": "没有检索到数据",
                            "sInfoFiltered": "(筛选自 _MAX_ 条数据)"
                        },
                        "aaSorting": [[6, "desc"]],
                        "iDisplayLength": 50,
                        "bPaginate": false,
                        "bFilter": false
                    });

            var state = '';
            var token = "<?php echo csrf_token(); ?>" ;
            var selectinput = '';
            var btn = $("#ctlBtn");
            $("#id-input-file-1").change(function(){
                selectinput = '1';
            });
            $("#id-input-file-2").change(function(){
                selectinput = '2';
            });

            var uploader = WebUploader.create({

                swf: '/assets/images/Uploader.swf',

                server: '/admin/modulefirmware/upfile',

                pick: '#picker',

                formData:{'_token':token},

                resize: false
            });

            $("input[type=file]").on("change", function (e) {
                uploader.addFiles(e.target.files);
            });

            uploader.on( 'fileQueued', function( file ) {
                //判断文件格式
                var arr = file.name.split('.');
                if(arr[arr.length-1] != 'bin'){
                    alert("请选择bin文件");
                    return false;
                }

                if($("#thelist-"+selectinput).html() != 0){
                    var fileid = $("#fileid-"+selectinput).val();
                    if($("input[name='firmware_w_url']").val() != '' && $("#"+fileid).find('span.state').html() == '已上传'){
                        $.ajax({
                            type : 'post',
                            url  : '/admin/modulefirmware/unlink',
                            data : {'url':$("input[name='firmware_w_url']").val()},
                            encode : true
                        })
                    }
                    if($("input[name='firmware_s_url']").val() != '' && $("#"+fileid).find('span.state').html() == '已上传'){
                        $.ajax({
                            type : 'post',
                            url  : '/admin/modulefirmware/unlink',
                            data : {'url':$("input[name='firmware_s_url']").val()},
                            encode : true
                        })
                    }
                    $("#thelist-"+selectinput).html('');
                    uploader.removeFile(fileid);
                }
                $("#fileid-"+selectinput).val(file.id);
                $("#thelist-"+selectinput).append( '<div id="' + file.id +'-'+ selectinput + '" class="item">' +
                '<h5 class="info" style="float: left; margin: 0 50px 0 17%;">' + file.name + '</h5>' +
                '<input type="hidden" id="successnum-'+selectinput+'" >'+
                '<span class="state" >等待上传...</span>' +
                '</div>' );
            });

            uploader.on( 'uploadProgress', function( file, percentage ) {
                var $li = $( '#'+file.id +'-'+ selectinput ),
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
                if(file.id == $("#fileid-1").val()){
                    $("input[name='firmware_w_url']").val(response.url);
                    $("input[name='firmware_w_size']").val(response.size);
                    $("#successnum-1").val('1');
                    $( '#'+file.id+'-1' ).find('span.state').text('已上传');
                }else{
                    $("input[name='firmware_s_url']").val(response.url);
                    $("#successnum-2").val('1');
                    $( '#'+file.id+'-2' ).find('span.state').text('已上传');
                }

            });

            uploader.on( 'uploadError', function( file,response ) {
                $( '#'+file.id+'-'+selectinput ).find('span.state').text('上传出错');
            });

            uploader.on( 'uploadComplete', function( file ) {
                $( '#'+file.id+'-'+selectinput ).find('.progress').fadeOut();
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
