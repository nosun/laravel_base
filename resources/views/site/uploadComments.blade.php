@extends('_layouts.admin')
@section('user_css')
    <style>
        #tool_tab .nav{
            height:35px;
        }
        #tool_tab .tab-content{
            min-height:80px;
        }

    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-sm-4">
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">批量上传评论</h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <!-- #section:custom/file-input -->
                                    <label class="ace-file-input"><input type="file" id="id-input-file-2"><span class="ace-file-container" data-title="Choose"><span class="ace-file-name" data-title="No File ..."><i class=" ace-icon fa fa-upload"></i></span></span><a class="remove" href="#"><i class=" ace-icon fa fa-times"></i></a></label>
                                </div>
                            </div>

                            <!-- #section:custom/file-input.filter -->
                            <label>
                                <input type="checkbox" name="file-format" id="id-file-format" class="ace">
                            </label>

                            <!-- /section:custom/file-input.filter -->
                        </div>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-header">
                        <h4 class="widget-title">批量上传评论</h4>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <!-- #section:custom/file-input -->
                                    <label class="ace-file-input"><input type="file" id="id-input-file-2"><span class="ace-file-container" data-title="Choose"><span class="ace-file-name" data-title="No File ..."><i class=" ace-icon fa fa-upload"></i></span></span><a class="remove" href="#"><i class=" ace-icon fa fa-times"></i></a></label>
                                </div>
                            </div>

                            <!-- #section:custom/file-input.filter -->
                            <label>
                                <input type="checkbox" name="file-format" id="id-file-format" class="ace">
                            </label>

                            <!-- /section:custom/file-input.filter -->
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
                        <div class="widget-main" style="background:#efe;height: 400px;">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('user_js')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#myTab li").on('click',function(){
            $("#msgWall").html('');
        });

        $("#termSearch").on('click',function(e){
            var formData ={
                url:$('#termUrl').val()
            };

            $.ajax({
                type : "post",
                url : "/site/searchTerm/",
                dataType:"json",
                data: formData,
                success:function(data){
                    var result = JSON.stringify(data, null, 4);
                    $("#msgWall").html($("<pre>").text(result));
                }
            })
        });


    </script>

@endsection
