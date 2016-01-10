@extends('_layouts.admin')

@section('content')
        <div class="page-content">
            <div class="page-header">
                <div class="alert alert-block alert-success">
                    <i class="ace-icon fa fa-check green"></i>

                    <?php echo $title ?>
                    <span id="msg" style="padding-left: 10px; "></span>

                </div>
            </div><!-- /.page-header -->
            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" accept-charset="utf-8" id ="myform">
                        <div class="form-group">
                            <label for="device_mac" class="col-sm-2 control-label">设备Mac</label>
                            <div class="col-xs-12 col-sm-6">
                                <input type="text" name="device_mac" id="device_mac" class="form-control">
                            </div>
                            <button class="btn btn-sm btn-primary" id="client" type="button">
                                <i class="ace-icon fa"></i>连接此设备
                            </button>
                            <button class="btn btn-sm btn-danger" id="closeclient" type="button" style="display: none;">
                                <i class="ace-icon fa"></i>断开此连接
                            </button>
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-sm-2 control-label">命令</label>
                            <div class="col-xs-12 col-sm-6">
                                <textarea class="form-control" rows="4" name="message" id="message"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="profile-info-value" style="margin-left: 16.5%;display:block;">
                            <input type="radio" name="status" value="upload" autocomplete="off">上报信息</span>
                            <input type="radio" name="status" value="command" checked autocomplete="off">发送信息</span>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-primary" id="sendcmd" type="button" disabled>
                                <i class="ace-icon fa fa-check"></i>确定
                            </button>
                        </div>
                    </form>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
        <div class="col-sm-6" style="width:90%;margin-left:5%;" >
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title lighter smaller">
                        <i class="ace-icon fa fa-comment blue"></i>
                        cmd
                    </h4>
                    <button type="button" class="btn btn-xs btn-danger" style="float: right;margin:5px 10px 0 0;" onclick="delall();">
                        清空
                    </button>
                </div>

                <div class="widget-body" style="height: 320px;">
                    <div class="widget-main no-padding">
                        <!-- #section:pages/dashboard.conversations -->
                        <div class="dialogs">
                            <div class="scroll-content" id="scroll-content">
                            </div>
                        </div>

                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div>
@endsection
@section('user_js')
    <script src="/js/cmdindex.js"></script>
    <script src="/assets/js/ace/elements.scroller.js"></script>
    <script src="/assets/js/ace/ace.sidebar-scroll-1.js"></script>
    <script>
        $('.dialogs,.comments').ace_scroll({
            size: 300
        });
    </script>
@endsection