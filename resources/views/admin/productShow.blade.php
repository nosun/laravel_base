@extends('_layouts.admin')
@section('user_css')
@endsection
@section('content')
    <link rel="stylesheet" href="../../assets/css/datepicker.css" />
    <div class="page-content" id="productShow">
        <div class="page-header" style="position: relative">
            <h1>
                {{ $title }}
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    &nbsp;<a href="/admin/product">返回</a>
                </small>
            </h1>
        </div>
        <div class="row">

            <div class="col-sm-10 col-sm-offset-1">
                <!-- #section:pages/invoice -->
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h4 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-leaf green"></i>
                            基本信息
                        </h4>
                        <!-- /section:pages/invoice.info -->
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div>
                                        <ul class="list-unstyled spaced" style="font-size:14px;">
                                            <li class="col-xs-12 col-sm-12">
                                                <i class="ace-icon fa fa-caret-right blue"></i>
                                                产品名称：<span class="blue">{{$product->name}}</span>
                                            </li>

                                            <li class="col-xs-12 col-sm-12">
                                                <i class="ace-icon fa fa-caret-right blue"></i>
                                                产品型号：<span class="blue">@if(isset($u_data['product'][$product->product_id])){{$u_data['product'][$product->product_id]}}@endif</span>
                                            </li>

                                            <li class="col-xs-12 col-sm-12">
                                                <i class="ace-icon fa fa-caret-right blue"></i>
                                                APP名称：<span class="blue">
                                                    @if(isset($u_data['app'][$product->app_id]))
                                                        {{$u_data['app'][$product->app_id]}}
                                                    @endif
                                                </span>
                                            </li>

                                            <li class="col-xs-12 col-sm-12">
                                                <i class="ace-icon fa fa-caret-right blue"></i>
                                                公司名称：
                                                <span class="blue">
                                                    @if(isset($u_data['company'][$product->company_id]))
                                                        {{$u_data['company'][$product->company_id]}}
                                                    @endif
                                                </span>
                                            </li>
                                            <li class="col-xs-12 col-sm-12">
                                                <i class="ace-icon fa fa-caret-right blue"></i>
                                                上市时间：<span class="blue">{{$product->show_time}}</span>
                                            </li>

                                            <li class="col-xs-12 col-sm-12">
                                                <i class="ace-icon fa fa-caret-right blue"></i>
                                                服务器：<span class="blue">{{$product->server_id}}#</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-large">
                        <h4 class="widget-title grey lighter">
                            <i class="ace-icon fa fa-cog blue"></i>
                            产品设置
                        </h4>
                        <!-- /section:pages/invoice.info -->
                    </div>

                    <div class="widget-body">
                        <div class="widget-main padding-24">
                            <form class="form-horizontal" action="/admin/product/{{$product->product_id}}" method="post">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="tabbable">
                                    <ul class="nav nav-tabs padding-16">
                                        <li class="active">
                                            <a data-toggle="tab" href="#edit-image" aria-expanded="true">
                                                <i class="green ace-icon fa fa-cog bigger-125"></i>
                                                产品设置
                                            </a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#edit-share" aria-expanded="false">
                                                <i class="purple ace-icon fa fa-rss bigger-125"></i>
                                                分享设置
                                            </a>
                                        </li>
                                        <li class="">
                                            <a data-toggle="tab" href="#edit-helper" aria-expanded="false">
                                                <i class="blue ace-icon fa fa-users bigger-125"></i>
                                                文档设置
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content profile-edit-tab-content">
                                        <div id="edit-image" class="tab-pane active">
                                            <div class="space-10"></div>
                                            <h4 class="header blue bolder smaller">基本设置</h4>
                                            @if ($u_data['admin']->hasRole(['super']))
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">公司</label>
                                                <div class="col-xs-12 col-sm-6">
                                                    <select id="company_id" name="company_id" class="form-control">
                                                       <option value='0'>请选择类型</option>
                                                        @foreach($u_data['company'] as $k=>$v)
                                                           <option value="{{$k}}" @if($k==$product->company_id) selected @endif>{{$v}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="display_name" class="col-sm-2 control-label">产品型号</label>
                                                <div class="col-xs-12 col-sm-6">
                                                    <select id="model_id" name="model_id" class="form-control">
                                                        <option value='0'>请选择类型</option>
                                                        @foreach($u_data['productModel'] as $k=>$v)
                                                            <option value="{{$k}}" @if($k==$product->model_id) selected @endif>{{$v}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-sm-2 control-label">服务器</label>
                                                <div class="col-xs-12 col-sm-6">
                                                    <input type="text" name="server_id" class="form-control" value="{{$product->server_id}}">
                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="description" class="col-sm-2 control-label">名称</label>
                                                <div class="col-xs-12 col-sm-6">
                                                    <input type="text" name="name" class="form-control" value="{{$product->name}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-sm-2 control-label">简介</label>
                                                <div class="col-xs-12 col-sm-6">
                                                    <textarea name="info" rows="4" class="form-control">{{$product->info}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-sm-2 control-label">出售时间</label>
                                                <div class="col-xs-12 col-sm-6">
                                                    <input type="text" name="show_time" class="form-control" data-date-format="yyyy-mm-dd" value="{{$product->show_time}}" />
                                                </div>
                                            </div>
                                            <div class="space-10"></div>
                                            <h4 class="header blue bolder smaller">Logo</h4>
                                            <div class="row">
                                                <input type="hidden" name="product_logo" value="{{$product->product_logo}}">
                                                <div class="col-xs-6 col-sm-3 center img_change" data-id="product_logo">
                                                    <span class="profile-picture">
                                                        <img id="product_logo"
                                                             class="img-responsive editable-click editable-empty" alt="Logo"
                                                             src="{{$product->product_logo}}"/>
                                                    </span>
                                                    <div class="space space-4"></div>
                                                    <div class="inline position-relative">
                                                        <a href="javascript:void(0)" class="img-responsive">
                                                            <span>公司 logo</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="edit-share" class="tab-pane">
                                            <div class="space-10"></div>
                                            <h4 class="header blue bolder smaller">分享设置</h4>
                                            <div class="form-group">
                                                <label for="display_name" class="col-sm-2 control-label">标题</label>
                                                <div class="col-xs-12 col-sm-6">
                                                    <input type="text" name="share_title" class="form-control" value="{{$product->share_title}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-sm-2 control-label">链接</label>

                                                <div class="col-xs-12 col-sm-6">
                                                    <input type="text" class="form-control" name="share_url" value="{{$product->share_url}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-sm-2 control-label">文字</label>
                                                <div class="col-xs-12 col-sm-6">
                                                    <textarea name="share_text" class="form-control" rows="4">{{$product->share_text}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-sm-2 control-label">图片</label>
                                                <input type="hidden" class="form-control" name="share_img" value="{{$product->share_img}}">
                                                <div class="col-xs-6 col-sm-3 center img_change" data-id="share_img">
                                                <span class="profile-picture">
													<img id="share_img" class="img-responsive editable-click editable-empty"
                                                         alt="分享图片"  src="{{$product->share_img}}"/>
												</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="edit-helper" class="tab-pane">
                                            <div class="space-10"></div>
                                            <h4 class="header blue bolder smaller">文档设置</h4>
                                            <script id="container" name="instruction" type="text/plain"><?php echo html_entity_decode($product->instruction,ENT_QUOTES,'utf-8');?>
                                            </script>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-5 col-md-6">
                                        <button class="btn btn-primary " type="submit">
                                            <i class="ace-icon fa fa-check bigger-110"></i>
                                            保存
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <!-- /section:pages/invoice -->
            </div>
        </div>

        <div id="img_change_modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue">更换图片</h4>
                    </div>
                    <form id="myform" class="no-margin" method="post" action="/admin/file">
                        <div class="modal-body">
                            <div class="space-4"></div>
                            <div style="width:75%;margin-left:12%;">
                                <input type="file" name="file"/>
                            </div>
                        </div>
                        <div class="modal-footer center">
                            <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> 上传
                            </button>
                            <button type="button" class="btn btn-sm" data-dismiss="modal"><i
                                        class="ace-icon fa fa-times"></i> 取消
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <!-- PAGE CONTENT BEGINS -->
        @endsection
        @section('user_js')
            <script src="/assets/js/date-time/bootstrap-datepicker.js"></script>
            <script src="/assets/js/ueditor/ueditor.config.js"></script>
            <script src="/assets/js/ueditor/ueditor.all.min.js"></script>
            <script src="/assets/js/ace/elements.fileinput.js"></script>
            <script type="text/javascript">
                jQuery(function ($) {
                    $('input[name=show_time]').datepicker({
                        autoclose: true,
                        todayHighlight: true
                    }).next().on(ace.click_event, function(){
                        $(this).prev().focus();
                    });
                    var ue = UE.getEditor('container');
                    $('.img-responsive').on('click', function () {
                        // 获取模态框
                        var modal = $("#img_change_modal");

                        modal.modal("show").on("hidden", function () {
                            modal.remove();
                        });

                        // 获取父级元素id
                        var pid = $(this).parents('.img_change').attr('data-id');

                        var form = $('#myform');
                        //you can have multiple files, or a file input with "multiple" attribute
                        var file_input = form.find('input[type=file]');
                        var upload_in_progress = false;
                        file_input.ace_file_input({
                            style: 'well',
                            btn_choose: '选择或者拖动文件到这里',
                            btn_change: null,
                            droppable: true,
                            thumbnail: 'large',

                            maxSize: 110000,//bytes
                            allowExt: ["jpeg", "jpg", "png", "gif"],
                            allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif"],

                            before_remove: function () {
                                if (upload_in_progress)
                                    return false;//if we are in the middle of uploading a file, don't allow resetting file input
                                return true;
                            },

                            preview_error: function (filename, code) {
                                //code = 1 means file load error
                                //code = 2 image load error (possibly file is not an image)
                                //code = 3 preview failed
                            }
                        });

                        file_input.on('file.error.ace', function (ev, info) {
                            if (info.error_count['ext'] || info.error_count['mime']) alert('Invalid file type! Please select an image!');
                            if (info.error_count['size']) alert('Invalid file size! Maximum 100KB');

                            //you can reset previous selection on error
                            //ev.preventDefault();
                            //file_input.ace_file_input('reset_input');
                        });


                        var ie_timeout = null;//a time for old browsers uploading via iframe

                        form.on('submit', function (e) {
                            e.preventDefault();

                            var files = file_input.data('ace_input_files');
                            if (!files || files.length == 0) return false;//no files selected

                            var deferred;
                            if ("FormData" in window) {
                                //for modern browsers that support FormData and uploading files via ajax
                                //we can do >>> var formData_object = new FormData(form[0]);
                                //but IE10 has a problem with that and throws an exception
                                //and also browser adds and uploads all selected files, not the filtered ones.
                                //and drag&dropped files won't be uploaded as well

                                //so we change it to the following to upload only our filtered files
                                //and to bypass IE10's error
                                //and to include drag&dropped files as well
                                var formData_object = new FormData();//create empty FormData object

                                //serialize our form (which excludes file inputs)
                                $.each(form.serializeArray(), function (i, item) {
                                    //add them one by one to our FormData
                                    formData_object.append(item.name, item.value);
                                });
                                //and then add files
                                form.find('input[type=file]').each(function () {
                                    var field_name = $(this).attr('name');
                                    //for fields with "multiple" file support, field name should be something like `myfile[]`

                                    var files = $(this).data('ace_input_files');
                                    if (files && files.length > 0) {
                                        for (var f = 0; f < files.length; f++) {
                                            formData_object.append(field_name, files[f]);
                                        }
                                    }
                                });

                                upload_in_progress = true;
                                file_input.ace_file_input('loading', true);

                                deferred = $.ajax({
                                    url: form.attr('action'),
                                    type: form.attr('method'),
                                    processData: false,//important
                                    contentType: false,//important
                                    dataType: 'json',
                                    data: formData_object
                                })

                            }
                            else {
                                //for older browsers that don't support FormData and uploading files via ajax
                                //we use an iframe to upload the form(file) without leaving the page

                                deferred = new $.Deferred; //create a custom deferred object

                                var temporary_iframe_id = 'temporary-iframe-' + (new Date()).getTime() + '-' + (parseInt(Math.random() * 1000));
                                var temp_iframe =
                                        $('<iframe id="' + temporary_iframe_id + '" name="' + temporary_iframe_id + '" \
								frameborder="0" width="0" height="0" src="about:blank"\
								style="position:absolute; z-index:-1; visibility: hidden;"></iframe>')
                                                .insertAfter(form);

                                form.append('<input type="hidden" name="temporary-iframe-id" value="' + temporary_iframe_id + '" />');

                                temp_iframe.data('deferrer', deferred);
                                //we save the deferred object to the iframe and in our server side response
                                //we use "temporary-iframe-id" to access iframe and its deferred object

                                form.attr({
                                    method: 'POST',
                                    enctype: 'multipart/form-data',
                                    target: temporary_iframe_id //important
                                });

                                upload_in_progress = true;
                                file_input.ace_file_input('loading', true);//display an overlay with loading icon
                                form.get(0).submit();

                                //if we don't receive a response after 30 seconds, let's declare it as failed!
                                ie_timeout = setTimeout(function () {
                                    ie_timeout = null;
                                    temp_iframe.attr('src', 'about:blank').remove();
                                    deferred.reject({'status': 'fail', 'message': 'Timeout!'});
                                }, 30000);
                            }

                            //deferred callbacks, triggered by both ajax and iframe solution
                            deferred
                                    .done(function (result) {//success
                                        var message;
                                        if (result.code == 200) {
                                            message = "文件上传成功";
                                            $("#" + pid).attr('src', result.url);
                                            $("input[name="+ pid+ "]").val(result.url);
                                            modal.modal('hide');
                                        }
                                        else {
                                            message = result.message;
                                            alert(message);
                                        }
                                    })
                                    .fail(function (result) {//failure
                                        alert("文件上传失败");
                                    })
                                    .always(function () {//called on both success and failure
                                        if (ie_timeout) clearTimeout(ie_timeout);
                                        ie_timeout = null;
                                        upload_in_progress = false;
                                    });

                            deferred.promise();
                        });

                        //when "reset" button of form is hit, file field will be reset, but the custom UI won't
                        //so you should reset the ui on your own
                        form.on('reset', function () {
                            $(this).find('input[type=file]').ace_file_input('reset_input_ui');
                        });

                        modal.on('hidden.bs.modal', function (e) {
                            form.unbind('submit');
                            file_input.ace_file_input('loading', false);
                            file_input.ace_file_input('reset_input');
                        })

                    });


                })
            </script>
@endsection
