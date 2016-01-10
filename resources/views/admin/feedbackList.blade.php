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

        <div class="widget-body" id="searchformdiv">
            <div class="profile-user-info profile-user-info-striped" style="width: 100%;">
                <form class="form-search" name="searchform" method="get" action="/admin/feedback" >
                    <div class="" style="width: 250px;">
                        <div class="profile-info-name"> 主题 </div>
                        <div class="profile-info-value">
                            <input type="text" name="searchtitle" placeholder="请输入主题" value="<?php echo isset($_GET['searchtitle'])? $_GET['searchtitle']:''; ?>"
                                   autocomplete="off" class="search-query">
                        </div>
                    </div>
                    <div class="" style="width:250px;float:left;">
                        <div class="profile-info-name"> 时间 </div>
                        <div class="profile-info-value">
                            <input type="text" name="searchtime" placeholder="请选择时间" value="<?php echo isset($_GET['searchtime'])? $_GET['searchtime']:''; ?>"
                                   data-date-format="yyyy-mm-dd" autocomplete="off" class="search-query">
                        </div>
                    </div>
                    <div class="" style="width:250px;float:left;">
                        <div class="profile-info-name"> 状态 </div>
                        <div class="profile-info-value">
                            <select name="searchstatus">
                                <option value="0">请选择状态</option>
                                @foreach($status as $k=>$v)
                                <option value="{{$k}}" <?php echo isset($_GET['searchstatus'])?($k==$_GET['searchstatus']?'selected':''):''; ?>>{{$v}}</option>
                                @endforeach
                            </select>
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
                    <div class="table-header">单页反馈列表</div>
                    <table class="table table-striped table-bordered table-hover dataTable" id="mytable" >
                    <thead>
                    <tr>
                        <th width="5%">id</th>
                        <th width="10%">主题</th>
                        <th width="10%">用户</th>
                        <th width="5%">反馈时间</th>
                        <th width="10%">产品名称</th>
                        <th width="10%">app版本</th>
                        <th width="10%">用户手机号</th>
                        <th width="5%">app_id</th>
                        <th width="5%">category</th>
                        <th width="10%">状态</th>
                        <th width="10%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $row)
                        <tr>
                            <input id="content_{{$row->id}}" type="hidden" value="{{$row->content}}" >
                            <td id="id_{{$row->id}}">{{$row->id}}</td>
                            <td id="title_{{$row->id}}">{{$row->title}}</td>
                            <td id="user_name_{{$row->id}}">{{$row->user_name}}</td>
                            <td id="addtime_{{$row->id}}">{{date('Y-m-d',$row->addtime)}}</td>
                            <td id="product_{{$row->id}}">@if($row->product_id!=''){{$arr[$row->product_id]}}@endif</td>
                            <td id="category_{{$row->id}}">{{$row->app_version}}</td>
                            <td id="category_{{$row->id}}">{{$row->phone}}</td>
                            <td id="category_{{$row->id}}">{{$row->app_id}}</td>
                            <td id="category_{{$row->id}}">{{$row->category}}</td>
                            <td id="status_{{$row->id}}"><?php echo $status[$row->status]; ?>
                            <td>
                                <div class="hidden-sm hidden-xs btn-group">
                                    <a class="btn btn-xs btn-warning" href="/admin/feedback/reply/{{$row->id}}" title="查看反馈">
                                        <i class="ace-icon fa fa-flag bigger-120"></i>
                                    </a>
                                    <button type="button" class="btn btn-xs btn-danger dangerinput" data-toggle="modal"
                                            data-target=".bs-example-modal-sm" title="删除" data-id="{{ $row->id }}">
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
                                                <a class="tooltip-info" href="/admin/feedback/reply/{{$row->id}}" title="查看反馈">
                                                    <span class="blue">
                                                        <i class="ace-icon fa fa-search-plus bigger-110"></i>
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

@endsection
@section('user_js')
    @if(!isset($list[0]) && isset($_GET['searchtitle']))
        <script>
            $(function(){
                alert('未搜索到结果');
                window.location.href="/admin/feedback";
            });
        </script>
    @endif
<script src="../assets/js/date-time/bootstrap-datepicker.js"></script>
<script src="/assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script type="text/javascript">
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
                url : "/admin/feedback/" + id,
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

        $('input[name=searchtime]').datepicker({
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
                            null, null, null,null,null,null,null,null,null,null,{ "bSortable": false }
                        ],
                        "oLanguage": {//下面是一些汉语翻译
                            "sSearch": "当前页搜索",
                            "sLengthMenu": "每页显示 _MENU_ 条记录",
                            "sInfo": "显示 _START_ 至 _END_ 条 &nbsp;&nbsp;共 _TOTAL_ 条",
                            "sInfoEmpty":"显示 0 至 0 条 &nbsp;&nbsp;共 0 条",
                            "sZeroRecords": "没有检索到数据",
                            "sInfoFiltered": "(筛选自 _MAX_ 条数据)"

                        },
                        "aaSorting": [[3, "desc"]],
                        "iDisplayLength": 50,
                        "bPaginate": false,
                        "bFilter": false
                    });
        });
    </script>


@endsection
