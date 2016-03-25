@extends('_layouts.admin')
@section('user_css')
    <style>
        .input-title{
            height:24px;
            line-height: 24px;
            margin:16px 0;
            font-weight:bold;
            font-size:16px;
        }
        .selectBox{
            width:60%;
        }
        .input-daterange{
            width:60%;
        }
        .file-upload{
            padding-left:0;
            width:62%;
            margin-right:30px;
        }

    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="row uploadArea">
            <div class="col-sm-4">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">批量上传评论</h4>
                    </div>
                    <div class="widget-body">
                        <div class="widget-main">
                            <form action="#" id="formUploadComments" enctype="multipart/form-data">
                                <div class="input-title">站点选择</div>
                                <div class="control-group">
                                    <select class="form-control selectBox" id="choose_site" name="site">
                                        @foreach($sites as $site)
                                            <option value="{{$site->db_name}}">{{$site->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="control-group">
                                    <div class="input-title">模式选择</div>
                                    <div class="control-group">
                                        <select class="form-control selectBox" id="mode" name="mode">
                                            <option value="insertComments">不指定目录或Tag</option>
                                            <option value="insertCommentsWithTid">指定目录或Tag</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="input-title">时间选择</div>
                                    <div class="input-daterange input-group">
                                        <input type="text" name="start" id="start" value="" class="input-sm form-control">
                                        <span class="input-group-addon">
                                            <i class="fa fa-exchange"></i>
                                        </span>
                                        <input type="text" name="end" id="end" value="" class="input-sm form-control">
                                    </div>
                                </div>

                                <div class="control-group clearfix">
                                    <div class="input-title">文件选择</div>
                                    <div class="col-xs-10 file-upload">
                                        <input type="file" name="file" id="file-upload" />
                                    </div>
                                    <button class="btn btn-info btn-sm" type="button" id="doUploadComments">
                                        上传
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="showLog col-sm-6">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">日志打印区</h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main" style="background:#efe;min-height:600px;" id="log_area">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('user_js')
    <script src="/assets/js/ace/elements.fileinput.js"></script>
    <link href="/assets/css/datepicker.css" rel="stylesheet"/>
    <script src="/assets/js/date-time/bootstrap-datepicker.js"></script>
    <script src="/assets/js/date-time/moment.js"></script>
    <script src="/assets/js/date-time/daterangepicker.js"></script>
    <script type="text/javascript">
        jQuery(function($){
            $('#file-upload').ace_file_input({
                no_file:'文件 ...',
                btn_choose:'选择',
                btn_change:'更换',
                allowExt:  ['csv']
            });
            $('.input-daterange').datepicker({
                autoclose:true,
                format: 'yyyy-mm-dd'
            });

            var log_area =  $("#log_area");
            var message  = '';
            var mode;

            $("#doUploadComments").on('click', function () {
                var fd = new FormData($('#formUploadComments')[0]);
                mode = $("#mode").val();
                fd.append("type", mode);
                $.ajax({
                    url: "/site/uploadFile",
                    type: "POST",
                    data: fd,
                    processData: false,  // 告诉jQuery不要去处理发送的数据
                    contentType: false   // 告诉jQuery不要去设置Content-Type请求头
                }).done(function(res) {
                    console.log(res.result.code);
                    if(res.code == 200){
                        message = '<p class="log">the file is already upload successd</p>' +
                                '<p class="log">the url of the file is ' + res.result.url + '</p>';
                        log_area.append(message);
                        insertComments(res.result.name,mode);
                    }
                }).fail(function(res) {
                    $("#log_area").append("fail");
                });
            });

            function insertComments(name,mode){
                var file ={
                    name: name,
                    start:$("#start").val(),
                    end:$("#end").val(),
                    site:$("#choose_site").val(),
                    mode:mode
                };
                $.ajax({
                    url: "/site/addComments",
                    type: "POST",
                    data: file
                }).done(function(res) {
                    switch (res.code){
                        case 200:
                            message = '<p>file format is ok!</p>' +
                                    '<p class="log">comment is already success add to database</p>' +
                                    '<p class="log">the success num is ' + res.result.success + '</p>' +
                                    '<p class="log">the failed num is ' + res.result.fail + ' </p>';
                                log_area.append(message);
                            break;
                        case 400:
                            message = '<p>参数错误</p>';
                            log_area.append(message);
                            break;
                        case 404:
                            message = '<p>文件不存在</p>';
                            log_area.append(message);
                            break;
                        case 405:
                            message = '<p>数据校验失败</p>' +
                                      '<p>' + res.result.message + '</p>';
                            log_area.append(message);
                            break;
                        default:
                            log_area.append('<p> something is error, please contact nosun</p>');
                    }
                    log_area.append('<p>------------------------我是华丽的分割线-------------------</p>');
                }).fail(function(res) {
                    $("#log_area").append("fail");
                });
            }
        })
    </script>

@endsection
