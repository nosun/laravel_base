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
                <table id="gird" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="10%">登录用户</th>
                        <th width="10%">登录IP</th>
                        <th width="10%">登录时间</th>
                        <th width="10%">登录结果</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($list as $row )
                        <tr>
                            <td id="user_{{$row->id}}">{{ $row->login_email }}</td>
                            <td id="action_{{$row->id}}">{{ $row->login_ip }}</td>
                            <td id="_{{$row->id}}">{{ date('Y年m月d日 h:i:s',$row->login_time) }}</td>
                            <td id="status_{{$row->id}}"><?php if($row->status == 1){echo '登录成功'; }else{echo '登录失败';} ?></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tbody>
                        <tr>
                            <td>
                                <a class="tooltip-success" href="/admin/cron">返回</a>
                                <a data-toggle="modal" data-target=".bs-example-modal-sm" title="删除" >
                                    批量删除
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <?php echo $list->render(); ?>
            </div>
            <!-- /.span -->
        </div>
        <!-- /.row -->
        <div id="delConfirmModal" class="modal fade bs-example-modal-sm" role="dialog" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">消息</h4>
                    </div>
                    <div class="modal-body" id="delMsg">
                        该操作将删除30天之前所有日志，确定要删除么?
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

@endsection
@section('user_js')
    <script type="text/javascript">
        $("#deleteIt").on('click',function(event){
            $.ajax({
                type : "DELETE",
                url : "/admin/adminlog/",
                dataType:"json",
                success:function(data){
                    if (data.msg == 200){
                        $('#delMsg').html('您已经成功删除信息')
                    }
                    setInterval(reload,500);
                }
            })
        });
        function reload(){
            window.location.reload();
        }
    </script>
@endsection
