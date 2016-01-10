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
        </h1>
    </div>

    <div class="widget-body" id="searchformdiv">
        <div class="profile-user-info profile-user-info-striped" style="width: 100%;">
            <form class="form-search" name="searchform" method="get" action="/admin/user" >
                <div class="" style="width:250px;">
                    <div class="profile-info-name"> app </div>
                    <div class="profile-info-value">
                        <input type="text" name="searchapp" placeholder="请输入app名称" value="<?php echo isset($_GET['searchapp'])? $_GET['searchapp']:''; ?>"
                               autocomplete="off" class="search-query">
                    </div>
                </div>
                <div class="" style="width:250px;float:left;">
                    <div class="profile-info-name"> 用户名 </div>
                    <div class="profile-info-value">
                        <input type="text" name="searchname" placeholder="请输入用户名" value="<?php echo isset($_GET['searchname'])? $_GET['searchname']:''; ?>"
                               autocomplete="off" class="search-query">
                    </div>
                </div>
                <div class="" style="width:300px;float:left;">
                    <div class="profile-info-name"> 手机号码 </div>
                    <div class="profile-info-value">
                        <input type="text" name="searchphone" placeholder="请输入手机号码" value="<?php echo isset($_GET['searchphone'])? $_GET['searchphone']:''; ?>"
                               data-date-format="yyyy-mm-dd" autocomplete="off" class="search-query">
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
                <!-- #section:custom/widget-box.options -->
                <div class="table-header">单页用户列表</div>
                <!-- <div class="table-responsive"> -->
                <!-- <div class="dataTables_borderWrap"> -->
                <table class="table table-striped table-bordered table-hover dataTable" id="mytable">
                <thead>
                <tr>
                    <th>app</th>
                    <th>登录名</th>
                    <th>登录类型</th>
                    <th>用户名</th>
                    <th>手机号码</th>
                    <th>注册时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($list as $row )
                    <tr>
                        <td>@if($row->app_id!=''){{ $u_data['app'][$row->app_id] }}@endif</td>
                        <td>{{ $row->login_id }}</td>
                        <td>{{ $row->user_type }}</td>
                        <td>{{ $row->user_name }}</td>
                        <td>{{ $row->user_phone }}</td>
                        <td>{{ date('Y-m-d',$row->reg_time) }}</td>
                        <td>
                            <div class="hidden-sm hidden-xs btn-group">
                                <a class="btn btn-xs btn-warning" href="/admin/user/{{$row->user_id}}" title="查看日志">
                                    <i class="ace-icon fa fa-flag bigger-120"></i>
                                </a>
                            </div>

                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        <li>
                                            <a class="tooltip-info" href="/admin/user/{{$row->user_id}}" title="查看日志">
                                                    <span class="blue">
                                                        <i class="ace-icon fa fa-search-plus bigger-110"></i>
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
            <?php echo $list->render(); ?>
        </div>
        <!-- /.span -->
    </div>
</div>


@endsection
@section('user_js')
    @if(!isset($list[0]) && isset($_GET['searchapp']))
        <script>
            $(function(){
                alert('未搜索到结果');
                window.location.href="/admin/user";
            });
        </script>
    @endif
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
            sid = <?php echo Auth::user()->id ?>;
            if (id == sid){
                $('#delMsg').html('您不能删除自己的账号！')
                event.preventDefault();
                return false;
            }
            $.ajax({
                type : "DELETE",
                url : "/admin/user/" + id,
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
                        "sInfoEmpty":"显示 0 至 0 条 &nbsp;&nbsp;共 0 条",
                        "sZeroRecords": "没有检索到数据",
                        "sInfoFiltered": "(筛选自 _MAX_ 条数据)"
                    },
                    "aaSorting": [[5, "desc"]],
                    "iDisplayLength": 50,
                    "bPaginate": false,
                    "bFilter": false
        });

        })
    </script>
@endsection
